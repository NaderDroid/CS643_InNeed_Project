<?php
/**
 * Created by IntelliJ IDEA.
 * User: nader
 * Date: 10/17/17
 * Time: 5:18 AM
 */

require_once './vendor/autoload.php';
use Twilio\TwiML;


$response = new Twiml();

$message = $response->message();

$sss = $_REQUEST['Body'];

$userZip = $_REQUEST['FromZip'];

/*
 *
 */


/*
 *
 */




    // works as a DB system here for stored responses

/*
 *
 * here is one thing, i was trying to retrieve user location info, but it didint work i guess
 * its due some security policy with carriers here in US. the 'FromCity' index returns null :((
 *
 */

$responseMessages = array('food'=> array('rep' => 'It looks like you are at ZIP: '.$userZip.'
Here is a list with available restaurants near you:
    i will be listing rests here'), 'rsc'=> array('rep' => 'It looks like you are at ZIP: '.$userZip.' Here is a list with publicly available facilities for power and Internet access '
    ),
    'shelter'=> array('rep' => 'It looks like you are at ZIP: '.$userZip.' Here is a list with available shelters in your area: 
    This will show homes available now'
    ),
    'trans'=> array('rep' => 'Here is a list of available drivers at: '.$userZip.'
    and finally this will include available trucks for public'
    ),
    'helper'=> array('rep' => ' Thank you for volunteering with us: 
    You are at '.$userZip.'. One of our team will contact you for more information'
    ),

);

//$defaultMessage, in case for first time using or non-matching texts;
$defaultMessage = "Welcome to In-Need emergency SMS portal,
    Please reply a command or text 'h' for help in your area..";


/*
 * if the user asked for help
 */

    $help =" You will receive filtered contents according your ZipCode: ".$userZip."
    1- 'Food': list of open restaurants
    2- 'RSC': Use this to list nearby access to power, Internet
    3- 'Shelter': list of available spaces 
    4- 'Trans': to reach available transportation in your area
    *All commands are case insensitive*";


/*
 * here iam taking off triming the sender message in case s/he wants to creep on me,
 * case sensitivity also spaces :))
 */

$msg = preg_replace("/[^A-Za-z0-9]/u", " ", $sss);
$msg = trim($msg);
$msg = strtolower($msg);
$sendDefault = true;

foreach ($responseMessages as $exist => $messages) {
    if ($exist == $msg) {
        $sss = $messages['rep'];

        $sendDefault = false;
    }

}

/**
 * Here i figure out what to send as a response according to the current value
 * of the default message*/


 if (($sss == "H") || ($sss == "h"))
{
    $message->body($help);
    echo $response;
    $sendDefault = false;

}
 else if ($sendDefault != false) {

    $message->body($defaultMessage);

    echo $response;


}

    else {
        $message->body($sss);
        echo $response;

}

/* THIS PART WORKS PERFECTLY

    if ( $sss == "What" )
    {
        $message->body('This is awesome');
        echo $response;
    }

    else
    {

        $message->body('Nader');
        echo $response;

    }

PERFECTLY ENDS HERE
*/









