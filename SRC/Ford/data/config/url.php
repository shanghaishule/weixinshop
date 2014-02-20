<?php 
return array (
  'URL_MODEL' => 0,
  'URL_HTML_SUFFIX' => '.html',
  'URL_PATHINFO_DEPR' => '-',
  'URL_ROUTER_ON' => true,
  'URL_ROUTE_RULES' => 
  array (
    '/^book\/$/' => 'book/index',
    '/^book-p(\d+)$/' => 'book/index?p=:1',
    '/^c(\d+)\/$/' => 'book/cate?cid=:1',
    '/^c(\d+)\/p(\d+)$/' => 'book/cate?cid=:1&p=:2',
    '/^album\/$/' => 'album/index',
    '/^album\/p(\d+)$/' => 'album/index?p=:1',
    '/^album\/c(\d+)$/' => 'album/index?cid=:1',
    '/^album\/c(\d+)\/p(\d+)$/' => 'album/index?cid=:1&p=:2',
    '/^album\/(\d+)\/$/' => 'album/detail?id=:1',
    '/^item\/(\d+).html$/' => 'item/index?id=:1',
    '/^ec\/$/' => 'exchange/index',
    '/^ec\/p(\d+)$/' => 'exchange/index?p=:1',
    '/^space$/' => 'space/index',
    '/^space\/(\d+)$/' => 'space/index?uid=:1',
  ),
);