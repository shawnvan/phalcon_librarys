<?php
namespace Phalcon\Datrie;

class DatrieFilter
{

    private $_dict = FALSE;

    private $_dictPath;

    public function __construct($dictPath)
    {
        $this->_dictPath = $dictPath;
        $this->_dict = trie_filter_load($dictPath);
    }

    private function _buildDict($dictData)
    {
        $this->_dict = trie_filter_new();
        foreach ($dictData as $keyword)
        {
            trie_filter_store($this->_dict, $keyword);
        }
        return trie_filter_save($this->_dict, $this->_dictPath);
    }

    public function search($keyword)
    {
        $result = ($this->_dict) ? trie_filter_search($this->_dict, $keyword) : FALSE;
        return $result;
    }

    public function buildDict($dictData)
    {
        return $this->_buildDict($dictData);
    }
}