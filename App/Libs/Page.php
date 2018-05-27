<?php

namespace Libs;

class Page
{
    static private $instance = null;
    private $totalPage = 0;
    private $curPage = 1;
    private $pageName = 'page';
    private $uriArr = [];
    private $domainPath = '';

    private function __construct($totalPage, $curpage)
    {
        $this->totalPage = $totalPage;
        $this->curPage = $curpage;
        $this->domainPath = $this->getDomainPath();
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance($totalPage, $curpage)
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self($totalPage, $curpage);
        }

        return self::$instance;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return isset($this->$name) ? $this->$name : '';
    }

    public function pagination()
    {
        $this->resetUriArr($this->pageName, 1);
        $leftDisable = $this->curPage <= 1 ? 'disabled' : '';
        $curUrl = !$leftDisable ? $this->domainPath . http_build_query($this->uriArr) : "javascript:void(0);";
        $templateLeft = '<ul class="pagination">
                        <li class="' . $leftDisable . '">
                            <a href="' . $curUrl . '">
                                <i class="icon-double-angle-left"></i>
                            </a>
                        </li>';

        $templateCenter = '';
        $i = 0;
        while ($i < $this->totalPage) {
            $templateCenter .= $this->buildCurPageTemplate($i + 1);
            $i++;
        }

        $this->resetUriArr($this->pageName, $this->totalPage);
        $rightDisable = $this->curPage >= $this->totalPage ? 'disabled' : '';
        $curUrl = !$rightDisable ? $this->domainPath . http_build_query($this->uriArr) : "javascript:void(0);";
        $templateRight = '<li class="' . $rightDisable . '">
                            <a href="' . $curUrl . '">
                                <i class="icon-double-angle-right"></i>
                            </a>
                        </li>
                    </ul>';

        return $templateLeft . $templateCenter . $templateRight;
    }

    public function requestUriToArr()
    {
        $urlParsed = parse_url($_SERVER['REQUEST_URI']);
        $queryStr = isset($urlParsed['query']) ? $urlParsed['query'] : '';

        if (empty($queryStr)) {
            return [];
        }

        $queryStrArr = explode('&', $queryStr);
        foreach ($queryStrArr as $kv) {
            $kvTmp = explode('=', $kv);

            $tmpKey = isset($kvTmp[0]) ? trim($kvTmp[0]) : '';
            $tmpVal = isset($kvTmp[1]) ? trim($kvTmp[1]) : '';

            $this->uriArr[$tmpKey] = $tmpVal;
        }

        return $this->uriArr;
    }

    public function buildCurPageTemplate($curPage)
    {
        $active = $this->curPage == $curPage ? 'active' : '';
        $this->resetUriArr($this->pageName, $curPage);

        return '<li class="' . $active . '"><a href="' . $this->domainPath . http_build_query($this->uriArr) . '">' . $curPage . '</a></li>';
    }

    public function getDomainPath()
    {
        return CommonMethods::getProtocol() . '://' . $_SERVER['HTTP_HOST'] . '/' . trim($_SERVER['PATH_INFO'], '/') . '?';
    }

    public function resetUriArr($key, $val)
    {
        $this->uriArr[$key] = $val;
    }
}
