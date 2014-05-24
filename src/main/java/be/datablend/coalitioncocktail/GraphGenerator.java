package be.datablend.coalitioncocktail;

import au.com.bytecode.opencsv.CSVReader;
import org.neo4j.graphdb.*;
import org.neo4j.kernel.EmbeddedGraphDatabase;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.HashMap;
import java.util.Map;

/**
 * Created with IntelliJ IDEA.
 * User: dsuvee
 * Date: 24/05/14
 * Time: 13:58
 * To change this template use File | Settings | File Templates.
 */
public class GraphGenerator {

    Map<String,String> handleMap = new HashMap<String,String>();
    Map<String,Integer> partyMap = new HashMap<String, Integer>();
    Map<String,Integer> sentimentMap = new HashMap<String,Integer>();
    Map<String,Node> nodeMap = new HashMap<String,Node>();

    private int getValue(String sentiment) {
        if (sentiment.equals("positive")) {
            return 1;
        }
        if (sentiment.equals("negative")) {
            return -1;
        }
        return 0;
    }

    public void generateGraph() {
        // Create the graph
        GraphDatabaseService graph = new EmbeddedGraphDatabase("coalition-graph");

        for (Map.Entry<String,Integer> sentiment : sentimentMap.entrySet()) {
            Transaction tx = graph.beginTx();
            String[] handles = sentiment.getKey().split("&&&&");
            Node startNode = getOrCreateNode(graph, handles[0]);
            Node endNode = getOrCreateNode(graph, handles[1]);
            Relationship relationship = startNode.createRelationshipTo(endNode, DynamicRelationshipType.withName("rel"));
            relationship.setProperty("value", sentiment.getValue());
            tx.success();
            tx.finish();
        }

        graph.shutdown();
    }


    private void createSentimentMap() throws IOException {
        BufferedReader in = new BufferedReader(new FileReader("./data/tweets_engagor.csv"));
        String str;
        while ((str = in.readLine()) != null) {
            System.out.println(str);
            String[] row = str.split("\t");
            String handles = row[0] + ";" + row[1];
            String[] mentionedHandles = handles.toLowerCase().replace("@","").split(";");
            String sentiment = row[6];
            String sentimentHandle = "";
            System.out.println(mentionedHandles[0]);
            for (int i = 0; i < mentionedHandles.length; i++) {
                String handle = mentionedHandles[i];
                for (int j = i + 1; j < mentionedHandles.length; j++) {
                    String mentionedHandle = mentionedHandles[j];
                    if (handleMap.containsKey(handle) && handleMap.containsKey(mentionedHandle) && !handle.equals(mentionedHandle)) {
                        if (mentionedHandle.compareTo(handle) < 1) {
                            sentimentHandle = mentionedHandle + "&&&&" + handle;
                        }
                        else {
                            sentimentHandle = handle + "&&&&" + mentionedHandle;
                        }
                        if (!sentimentMap.containsKey(sentimentHandle)) {
                            sentimentMap.put(sentimentHandle,0);
                        }
                        int value = getValue(sentiment);
                        sentimentMap.put(sentimentHandle,sentimentMap.get(sentimentHandle) + value);
                    }
                }
            }
            System.out.println(sentimentMap.size());
        }
    }

    private void createHandleMap() throws IOException {
        CSVReader csvReader = new CSVReader(new FileReader("handles.tsv"), '\t');
        String[] row;

        int partyIndex = 1;

        // Read the rows and convert
        while ((row = csvReader.readNext()) != null) {
            String handle = row[0].toLowerCase();
            String party = row[1];
            handleMap.put(handle, party);
            if (!partyMap.containsKey(party)) {
                partyMap.put(party, partyIndex);
                partyIndex++;
            }
        }
    }

    private Node getOrCreateNode(GraphDatabaseService graph, String handle) {
        if (!handleMap.containsKey(handle)) {
            return null;
        }
        if (!nodeMap.containsKey(handle)) {
            Node node = graph.createNode();
            node.setProperty("name", handle);
            node.setProperty("party", partyMap.get(handleMap.get(handle)));
            node.setProperty("mentions", 0);
            nodeMap.put(handle, node);
        }
        Node node = nodeMap.get(handle);
        node.setProperty("mentions", (Integer)node.getProperty("mentions") + 1);
        return node;
    }

    public static void main(String[] args) throws IOException {
        GraphGenerator generator = new GraphGenerator();
        generator.createHandleMap();
        generator.createSentimentMap();
        generator.generateGraph();
        System.out.println("generated");
    }


}
