<?php
/**
 * User: Hyoseok Kim(toriworks@gmail.com)
 * Date: 2013. 10. 26.
 * Time: 오전 1:33
 */

/**
 * 데이터베이스 커넥션을 관리하는 클래스
 * 호스팅 업체마다 connection을 맺는 방법의 지원 메소드가 다를 수 있다.
 * cafe24인 경우에 mysql_pconnect를 지원하지 않는다.
 */
class ConnectionFactory {
    //
    // 데이터베이스 접속 정보 설정
    static $SERVERS = array(
        array(
            'host' => 'localhost',
            'username' => 'ipgroup1',
            'password' => 'ipgroup123',
            'database' => 'ipgroup1'
        )
    );

    // 코드에서 지원하는 커넥션 풀을 통해서 커넥션 객체를 얻음
    public static function create() {
        $cons = array();
        for ($i = 0, $n = count(ConnectionFactory::$SERVERS); $i < $n; $i++) {
            $server = ConnectionFactory::$SERVERS[$i];
            $con = mysql_connect($server['host'], $server['username'], $server['password']);
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