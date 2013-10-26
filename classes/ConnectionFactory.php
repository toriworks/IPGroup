<?php
/**
 * Created by IntelliJ IDEA.
 * User: toriworks
 * Date: 2013. 10. 26.
 * Time: 오전 1:33
 * To change this template use File | Settings | File Templates.
 */

class ConnectionFactory {
    static $SERVERS = array(
        array(
            'host' => 'localhost',
            'username' => 'ipgroup',
            'password' => 'ipgroup1',
            'database' => 'ipgroup'
        )
    );

    public static function create() {
        $cons = array();
        for ($i = 0, $n = count(ConnectionFactory::$SERVERS); $i < $n; $i++) {
            $server = ConnectionFactory::$SERVERS[$i];
            $con = mysql_pconnect($server['host'], $server['username'], $server['password']);
            if (!($con === false)) {
                if (mysql_select_db($server['database'], $con) === false) {
                    echo('Could not select database: ' . mysql_error());
                    continue;
                }
                $cons[] = $con;
            }
        }
        // If no servers are responding, throw an exception.
        if (count($cons) == 0) {
            throw new Exception
            ('Unable to connect to any database servers - last error: ' . mysql_error());
        }
        // Pick a random connection from the list of live connections.
        $serverIdx = rand(0, count($cons)-1);
        $con = $cons[$serverIdx];
        // Return the connection.
        return $con;
    }
}