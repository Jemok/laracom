<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Recombee\RecommApi\Client;
use Recombee\RecommApi\Requests as Reqs;
use Recombee\RecommApi\Exceptions as Ex;

class DBController extends Controller
{

    protected $client;

    public function __construct() {

    }

    public function createRecommendationDb(){

        $this->client = new Client('laracom', 'KoZox0Mq535SdL1qUwOQD9zjIdFnYjjtlSmx54EmGM5XZm1owuLIIOUM24L00OpD');

        $this->client->send(new Reqs\ResetDatabase());

        // Add properties of items
        $this->client->send(new Reqs\AddItemProperty('name', 'string'));
        $this->client->send(new Reqs\AddItemProperty('slug', 'string'));
        $this->client->send(new Reqs\AddItemProperty('price', 'double'));
        $this->client->send(new Reqs\AddItemProperty('quantity', 'int'));
        $this->client->send(new Reqs\AddItemProperty('description', 'string'));

        dd('db created');
    }
}
