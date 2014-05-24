<?php

$string = file_get_contents("../data/accountsWithHandle.json");
$json = json_decode($string, true);

    static $partijmap = array(
        'B.U.B Social Profiles' => 'bub',
        'CD&V Social Profiles' => 'cdenv',
        'CDH Social Profiles' => 'cdh',
        'Debout Les Belges Social Profiles' => 'debout_les_belges',
        'Ecolo Social Profiles' => 'ecolo', 
        'FDF Social Profiles' => 'fdf',
        'Groen Social Profiles' =>'groen',
        'LDD Social Profiles' => 'ldd', 
        'MR Social Profiles' => 'mr', 
        'N-VA Social Profiles' => 'nva', 
        'Open VLD Social Profiles' => 'openvld', 
        'Pirate Party Social Profiles' => 'pirateparty', 
        'PS Social Profiles'  => 'ps',
        'PTB Social Profiles' => 'ptb', // 
        'PVDA Social Profiles' => 'pvda', // 
        'Sp.a Social Profiles' => 'spa', // 
        'Vlaams Belang Social Profiles' => 'vlaamsbelang' // 
    );
    
    static $topicIds = array(
// PROJECT Candidates - Federal - Social Profiles
        25558 => 'cdenv', // Federal Candidates CD&V Social Profiles
        25559 => 'cdh', // Federal Candidates CDH Social Profiles
        25560 => 'ecolo', // Federal Candidates Ecolo Social Profiles
        25561 => 'fdf', // Federal Candidates FDF Social Profiles
        25570 => 'groen', // Federal Candidates Groen Social Profiles
        25562 => 'mr', // Federal Candidates MR Social Profiles
        25563 => 'nva', // Federal Candidates NVA Social Profiles
        25571 => 'openvld', // Federal Candidates Open VLD Social Profiles
        25565 => 'ps', // Federal Candidates PS Social Profiles
        25566 => 'ptb', // Federal Candidates PTB Social Profiles
        25567 => 'pvda', // Federal Candidates PVDA Social Profiles
        25568 => 'spa', // Federal Candidates SP.a Social Profiles
        25569 => 'vlaamsbelang', // Federal Candidates Vlaams Belang Social Profiles
// PROJECT Parties - General Social Profiles
        26758 => 'bub', // B.U.B Social Profiles
        25545 => 'cdenv', // CD&V Social Profiles
        25546 => 'cdh', // CDH Social Profiles
        26735 => 'debout_les_belges', // Debout Les Belges Social Profiles
        25547 => 'ecolo', // Ecolo Social Profiles
        25548 => 'fdf', // FDF Social Profiles
        25549 => 'groen', // Groen Social Profiles
        26756 => 'ldd', // LDD Social Profiles
        25550 => 'mr', // MR Social Profiles
        25551 => 'nva', // N-VA Social Profiles
        25552 => 'openvld', // Open VLD Social Profiles
        26731 => 'pirateparty', // Pirate Party Social Profiles
        25553 => 'ps', // PS Social Profiles
        25554 => 'ptb', // PTB Social Profiles
        25555 => 'pvda', // PVDA Social Profiles
        25556 => 'spa', // Sp.a Social Profiles
        25557 => 'vlaamsbelang' // Vlaams Belang Social Profiles      
    );



#echo $json_a['response']
#var_dump($json);

#var_dump($json['response']['data']['0']['projects']['0']['topics']);

foreach($json['response']['data']['0']['projects'] as $project){
#$project = $json['response']['data']['0']['projects']['1'];
#	echo "PROJECT\n";
	foreach($project['topics'] as $topic) {
#		echo "> " . $topic['name'] . "\n";
		
		foreach($topic['monitoredprofiles'] as $profile) {
			$topicname= $topic['name'];
			$partij=$topicIds[$topic['id']];
			if($profile['type']=='twitter' && !is_null($partij)) {
#			if($profile['type']=='twitter') {
#			if(!is_null($partij)) {
				echo $profile['username'] . "\t" . $partij. "\t" . $topic['name'] ."\n";
			}
		}
		
	}

}
#echo $json['response']->count;


?>
