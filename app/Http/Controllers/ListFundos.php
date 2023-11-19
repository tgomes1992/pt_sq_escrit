<?php

namespace App\Http\Controllers;

use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ListFundos extends Controller
{
    public static function formatar_resposta($xmlbody){

        $xml = new DOMDocument();
        $xml->loadXML($xmlbody);
        $fundos = $xml->getElementsByTagName('fundo');
        $retorno = [];

        foreach ($fundos as $fundo) {
           $item = [
             "codigo" => $fundo->getElementsByTagName("codigo")[0]->nodeValue , 
             "razaoSocial" => $fundo->getElementsByTagName("razaoSocial")[0]->nodeValue , 
             "custodiante" => $fundo->getElementsByTagName("custodiante")[0]->nodeValue , 
             "gestorPrincipal" => $fundo->getElementsByTagName("gestorPrincipal")[0]->nodeValue  ,
             "administrador" => $fundo->getElementsByTagName("administrador")[0]->nodeValue ,
             "tipoFundo" => $fundo->getElementsByTagName("tipoFundo")[0]->nodeValue , 
             "dataPosicao" => $fundo->getElementsByTagName("dataPosicao")[0]->nodeValue 
           ];
               
            array_push($retorno, $item);

        }

        return $retorno;


   }

    
    public static function ListFundosJcot(){
        $base_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tot="http://totvs.cot.webservices">
        <soapenv:Header>
                <wsse:Security soapenv:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
                <wsse:UsernameToken wsu:Id="UsernameToken-1" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
                <wsse:Username>roboescritura</wsse:Username>
                <wsse:Password Typ="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">Senh@123</wsse:Password>
                </wsse:UsernameToken>
                </wsse:Security>
        </soapenv:Header>
        <soapenv:Body>
           <tot:ListFundosRequest>
              <tot:fundo>
                 <tot:login>roboescritura</tot:login>
              </tot:fundo>
           </tot:ListFundosRequest>
        </soapenv:Body>
     </soapenv:Envelope>' ;

     $endpoint = "https://oliveiratrust.totvs.amplis.com.br:443/jcotserver/services/FundosService";

     $response = Http::withHeaders([
        'Content-Type' => 'text/xml , charset=utf-8',
    ])->send('POST', $endpoint , ['body' => $base_request]);

      $body  = $response->body();

     return ListFundos::formatar_resposta($body) ;
    
   }



}
