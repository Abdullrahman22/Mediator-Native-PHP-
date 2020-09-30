<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;



class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        echo "Server Started!!!";
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
        , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        /*======== include DB ==========*/
        require '../includes/config/db.php';

        /*======== get json data ==========*/
        $data = json_decode($msg , true);

        /*======== show messege for all users and  me ==========*/
        foreach ($this->clients as $client) {
                $client->send($msg);
        }


        /*======== show messege for all users and  me ==========*/
        $msg       = $data['msg'];
        $msg_type  = $data['msg_type'];
        $receiver  = $data['receiver'];
        $sessionId = $data['sessionId'];
        $chat_Link = $data['chat_Link'];


        $stmt = $con->prepare(" INSERT INTO 
                messages ( chat_Link ,  `message` , msg_type , Sender_ID , Receiver_ID )
                VALUES( :zchat_Link , :zmessage , :zmsg_type , :zSender_ID , :zReceiver_ID ) ");
        $stmt->execute(array(
            ":zchat_Link"    => $chat_Link,
            ":zmessage"      => $msg,
            ":zmsg_type"     => $msg_type,
            ":zSender_ID"    => $sessionId,
            ":zReceiver_ID"  => $receiver,
        ));

        

    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}