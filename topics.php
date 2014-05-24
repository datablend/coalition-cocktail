<?php

$string = file_get_contents("/Users/quentin/misc-repos/coalition-cocktail/untitled/accountsWithHandle.json");
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
	echo "// PROJECT " . $project['name']. "\n";
	foreach($project['topics'] as $topic) {
		echo "        " . $topic['id'] . " => '', // ". $topic['name'] . "\n";
		
		
	}

}
#echo $json['response']->count;


?>
