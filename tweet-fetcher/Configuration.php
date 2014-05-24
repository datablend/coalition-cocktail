<?php

class Configuration {

    const ACCESS_TOKEN = '5e301cf7cad5ed3aaadeda9823096bf2';
    const ACCOUNT_ID = 14083;

    const TWITTER_USER_MENTION = '/(@(?:<b>;)?)([A-Za-z0-9_]+)/u';

    static $filters = array(
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
}