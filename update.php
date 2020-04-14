#!/usr/bin/php
<?php
//Change the web path below with your website root full path.
$web_path='/home/omcrates/public_html/';

/*function AllCryptBTC() {
		$json  =  file_get_contents ( 'https://www.allcrypt.com/api?method=singlemarketdata&marketid=672' );
		$obj  =  json_decode ( $json );
		return $obj ->{ 'return' }-> markets -> OMC -> lasttradeprice ;
}*/

function Bittrex($ticker) {
		$json = file_get_contents ( 'https://bittrex.com/api/v1.1/public/getticker?market=BTC-'.$ticker );
		$obj = json_decode ($json);
		return number_format($obj->result->Last, 8);
}
function CoinBaseUSD() {
		$json  =  file_get_contents ( 'https://coinbase.com/api/v1/prices/buy' );
		$obj  =  json_decode ( $json );
		return $obj -> amount ;
}
function BitStampUSD() {
                $json  =  file_get_contents ( 'https://www.bitstamp.net/api/ticker/' );
                $obj  =  json_decode ( $json );
                return $obj -> last ;
}
function BTCeUSD() {
		$json  =  file_get_contents ( 'https://btc-e.com/api/3/ticker/btc_usd-btc_btc?ignore_invalid=1' );
		$obj  =  json_decode ( $json );
		return $obj -> btc_usd-> last ;
}
function BTCeGBP() {
                $json = file_get_contents ( 'https://btc-e.com/api/3/ticker/btc_gbp-btc_btc?ignore_invalid=1' );
                $obj = json_decode ( $json );
                return $obj -> btc_gbp-> last;
}
function BTCeEUR() {
                $json = file_get_contents ( 'https://btc-e.com/api/3/ticker/btc_eur-btc_btc?ignore_invalid=1' );
                $obj = json_decode ( $json );
                return $obj -> btc_eur-> last;
}
function getTimeValue() {
	return date("d M Y h:i:s");
}
$currencies = array(
	'usdcoinbase' => CoinBaseUSD(),
	'usdbitstamp' => BitStampUSD(),
	'usdbtce' => BTCeUSD(),
	'gbp' => 1/BTCeGBP(),
	'eur' => 1/BTCeEUR(),
	'omc' => Bittrex('OMC'),
	'ltc' => Bittrex('LTC'),
        'doge' => Bittrex('DOGE'),
	'dash' => Bittrex('DASH'),
	'updated' => getTimeValue()
);
file_put_contents($web_path.'/rates.json', json_encode($currencies), LOCK_EX);
?>

