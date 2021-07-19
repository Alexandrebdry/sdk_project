<?php

Class Provider {


	private $clientID ;
	private $clientSecret ;
	private $urlAuth ;
	private $urlToken;
	private $urlResult;

	public function __construct(string $clientID, string $clientSecret,string $urlAuth, string $urlToken, string $urlResult){
		$this->clientID = $clientID ;
		$this->clientSecret = $clientSecret;
		$this->urlAuth = $urlAuth;
		$this->urlToken = $urlToken ;
		$this->urlResult = $urlResult ;
	}

	public function getUser(array $params) {

		$result = file_get_contents(
			$this->url . "client_id=" . $this->client_id
			. "&client_secret=" . $this->clientSecret
			. "&" . http_build_query($params)
		);
		
		$token = json_decode($result,true)["access_token"] ;

		//Getting user by Token
		$context = stream_context_create([
			"http"=>
				[
					"method"=>"GET",
					"header"=>"
						Authorization:
						Bearer " . $token
				]
		]);

		$result = file_get_contents($this->urlResult, false, $context);

		$user = json_decode($result,true) ; 
		var_dump($user) ;
	}

	public function getUrlAuth() {
		return $this->urlAuth ;
	}


}