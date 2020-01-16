<?php

namespace App\Service\Bitgo;

use App\Models\User;
use App\Models\Wallet;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BitgoService
{

	public $url = 'https://test.bitgo.com/api/v2';
	public $expressUrl = 'localhost:3080/api/v2';
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function createWallet(Request $request, Wallet $wallet)
	{
		try {
			$response = $this->client->request(
				'POST', $this->expressUrl . "/{$request->coin}/wallet/generate", [
					'headers' => $this->getBitgoHeaders(),
					'json' => [
						'label' => "{$wallet->label}",
						'passphrase' => "{$wallet->passphrase}"
					]
				]
			);
			
		} catch (Exception $e) {
			dd($e->getMessage());
		}

		return json_decode($response->getBody(), false);
	}

	public function listWallets()
	{
		try {
			$response = $this->client->request(
				'GET', $this->expressUrl . '/tltc/wallet', [
					'headers' => $this->getBitgoHeaders()
				]
			);
			
		} catch (Exception $e) {
			dd($e->getMessage());
		}

		return json_decode($response->getBody(), false);
	}

	public function allTransactions(Request $request, Wallet $wallet)
	{
		try {
			$response = $this->client->request(
				'GET', $this->expressUrl . "/{$wallet->coin}/wallet/{$wallet->wallet_id}/transfer", [
					'headers' => $this->getBitgoHeaders()
				]
			);
			
		} catch (Exception $e) {
			dd($e->getMessage());
		}

		return json_decode($response->getBody(), false);
	}


	public function getWallet(Request $request, Wallet $wallet)
	{
		try {
			$response = $this->client->request(
				'GET', $this->expressUrl . "/{$wallet->coin}/wallet/{$wallet->wallet_id}", [
					'headers' => $this->getBitgoHeaders()
				]
			);
			
		} catch (Exception $e) {
			dd($e->getMessage());
		}

		return json_decode($response->getBody(), false);
	}

	public function unlock()
	{
		try {
			$response = $this->client->request(
				'POST', $this->expressUrl . "/user/unlock", [
					'headers' => $this->getBitgoHeaders(),
					'json' => [
						'otp' => "0000000",
					]
				]
			);
			
		} catch (Exception $e) {
			dd($e->getMessage());
		}

		return json_decode($response->getBody(), false);
	}

	public function createWalletAddress()
	{
		try {
			$response = $this->client->request(
				'POST', $this->expressUrl . '/tltc/wallet/5e175d6f8e90d31c06b1c143ef97bd34/address', [
					'headers' => $this->getBitgoHeaders(),
					'json' => [
						'label' => 'somewalletlabel',
					]
				]
			);
			
		} catch (Exception $e) {
			dd($e->getMessage());
		}

		return json_decode($response->getBody(), false);
	}

	public function sendMoney(Request $request, Wallet $wallet)
	{
		try {
			$response = $this->client->request(
				'POST', $this->expressUrl . "/{$wallet->coin}/wallet/{$wallet->wallet_id}/sendcoins", [
					'headers' => $this->getBitgoHeaders(),
					'json' => [
						'amount' => $request->amount * 1e8,
						'address' => $request->address,
						'walletPassphrase' => md5($wallet->passphrase)
					]
				]
			);
			
		} catch (Exception $e) {
			dd($e->getMessage());
		}

		return json_decode($response->getBody(), false);
	}

	public function tranfers(Request $request)
	{
		try {
			$response = $this->client->request(
				'GET', $this->expressUrl . "/{$request->coin}/transfer", [
					'headers' => $this->getBitgoHeaders(),
					'query' => [
						'enterpriseId' => '5e1046f11f88b332061c504efb7d7f41',
						'height' => 2000,
					]
				]
			);
			
		} catch (Exception $e) {
			dd($e->getMessage());
		}

		return json_decode($response->getBody(), false);
	}

	public function user()
	{
		try {
			$response = $this->client->request(
				'GET', $this->expressUrl . "/user/me", [
					'headers' => $this->getBitgoHeaders(),
				]
			);
			
		} catch (Exception $e) {
			dd($e->getMessage());
		}

		return json_decode($response->getBody(), false);
	}

	protected function getBitgoHeaders()
	{
		return [
			"Accept"     => "application/json",
			"Authorization" => "Bearer " .config('services.bitgo.secret'),
			// "Content-Type" => "application/x-www-form-urlencoded",
			// "Content-Type" => "application/json"
		];
	}

	protected function getWalletCredntials()
	{
		return json_encode([
			'label' => 'somewalletlabel',
			'passphrase' => 'somesuperlongphraseforthewallet'
		]);
	}
}