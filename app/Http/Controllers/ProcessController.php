<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;


class ProcessController extends Controller
{
    public function distribute(Request $request)
    {

        $numPeople = $request->numPeople;
        $card_type = array('S', 'H', 'D', 'C'); //Spade(S), Heart(H), Diamond(D), Club(C)
        $card_numbers = array('A', '2', '3', '4', '5', '6', '7', '8', '9', 'X', 'J', 'Q', 'K'); //1 to 13
        $cards = array();

        //combination all card type and number
        foreach($card_type as $type) {
            foreach($card_numbers as $number) {
                $cards[] = $type."-".$number;
            }
        }

        // Shuffle the collection.
        $collection = collect($cards);
        $shuffled = $collection->shuffle();
        $shuffled->all();
     
        $cardPerPerson = floor(52 / $numPeople);
        $extraCard = 52-($cardPerPerson * $numPeople); //extra card will be give at first count first serve
        $result = '';
        $countCardAlreadyDistribute = 0;

        for($i = 0; $i < $numPeople; $i++) {
            $result .= 'Player '.($i + 1).' Card : ';

            // to check which player got extra card
            if($i < $extraCard){
                $addonExtraCard = 1;
            }else{
                $addonExtraCard = 0;
            }


            for($j = $countCardAlreadyDistribute; $j <  $countCardAlreadyDistribute + $cardPerPerson + $addonExtraCard; $j++) {
                if ($j < 52) {
                    if($j == $countCardAlreadyDistribute + $cardPerPerson + $addonExtraCard - 1){
                        $result .= $shuffled[$j];
                    }else{
                        $result .= $shuffled[$j].',';
                    }
                }
            }

            $countCardAlreadyDistribute = $j;

            $result .= '<br/>';

        }

        $data_modal['result'] = $result;

        return $data_modal;
    }
}
