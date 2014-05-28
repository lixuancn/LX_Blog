<?php
/**
 * 模板文件
 * Created by PhpStorm.
 * User: lane
 * Date: 14-3-17
 * Time: 下午2:21
 * Mail lixuan868686@163.com
 * Blog http://www.lanecn.com
 */
class LaneTemplate {

    protected $data = array();

    protected $drillmode = 0;

    function __construct($s) {
        if(file_exists($s)) $s = file_get_contents($s);
        $this->find_var($s);
        $this->data = explode('<', $s);
        $this->data[0] = '<?php $_st=$_var=array();?>';
        $this->find_dsn();
    }
    //新增 run 方法，
    function run() {
        //include "data://," . join('<', $this->data);
        eval('?>' . join('<', $this->data));
    }
    function find($pattern) {
        $this->pattern = $pattern;
        return array_filter($this->data, array($this, 'find_callback'));
    }
    private function find_dsn() {
        foreach($this->find("#\bdsn\b#i") as $k=>$v) {
            $t = $this->find_tag($tag = strtok($v, ' '), $k);
            end($t);
            $dsn[] = array( $k, key($t) );
        }
        if($this->drillmode) {
            foreach($this->find("#\bdrill\b#i") as $k=>$t) {
                foreach($dsn as $i=>$v) if($k < $v[1] && $k > $v[0]) $t = $i;
                $drill[] = $dsn[$t];
                unset($dsn[$t]);
            }
        }
        foreach($dsn as $v) {
            list($start, $end) = $v;
            preg_match('/\bdsn\s*=\s*([^\s>]+)/i', $this->data[$start], $reg);
            $this->data[$start] = str_replace(' '.$reg[0], '', $this->data[$start]);

            $m = explode(',', trim($reg[1], '\'"')) + array(0, 0, '');
            $code_start = "?php if(isset(\$_var))\$_st[]=\$_var;foreach((isset(\$_var['$m[0]'])?\$_var['$m[0]']:\$this->$m[0]('$m[1]','$m[2]')) as \$_key=>\$_var){?>";
            $code_end = "?php }\$_var=array_pop(\$_st);?>";
            switch($m[1]) {
                case 0:
                    $t = explode('>', $this->data[$start]);
                    $t[1] = "<$code_start" . $t[1];
                    $this->data[$start] = join('>', $t);
                    $this->data[$end] = "$code_end<" . $this->data[$end];
                    break;
                case 1:
                    $this->data[$end] .= "<$code_end";
                    $this->data[$start] = "$code_start<" . $this->data[$start];
                    break;
                default:
                    $n = round(100/$m[1]);
                    $this->data[$end] .= "</dt><$code_end";
                    $this->data[$start] = "$code_start<dt style='float:left;width:$n%;margin:0px;padding:0px'><" . $this->data[$start];
                    break;
            }
        }
        if($this->drillmode) foreach($drill as $v) {
            list($start, $end) = $v;
            preg_match('/\bdsn\s*=\s*([^\s>]+)/i', $this->data[$start], $reg);
            $this->data[$start] = str_replace(' '.$reg[0], '', $this->data[$start]);
            $m = explode(',', trim($reg[1], '\'"')) + array(0, 0, '');
            $code = '';
            for($i=$start; $i<=$end; $i++) {
                $code .= '<' . $this->data[$i];
                if($i > $start) unset($this->data[$i]);
            }
            $code = addslashes($code);
            $this->data[$start] = "?php \$_code='$code';\$this->drill(\$_code, isset(\$_var['$m[0]'])?\$_var['$m[0]']:\$this->$m[0]('$m[1]','$m[2]'));?>";
        }
    }
    protected function find_tag($tag, $offs=0) {
        $r = array();
        $counter = 0;
        foreach($this->find("#^/?$tag#i") as $k=>$v) {
            if($k >= $offs) {
                $counter += $v{0} == '/' ? 1 : -1;
                $r[$k] = $v;
                if($counter == 0) break;
            }
        }
        return $r;
    }
    protected function find_callback($v) {
        return preg_match($this->pattern, $v);
    }
    private function find_var(&$s) {
        $s = preg_replace_callback('/\{(\w+)\}/', array($this, 'var_callback'), $s);
    }
    protected function var_callback($r) {
        if($r[1] == 'drill') {
            $this->drillmode++;
            return '<?php if(isset($_var[\'child\'])) $this->drill($_code, $_var[\'child\']);?>';
        }
        return "<?php echo isset(\$_var['$r[1]'])?\$_var['$r[1]']:'';?>";
    }
    protected function drill($_code, $_source) {
        if(empty($_source) || ! is_array($_source)) return array();
        foreach($_source as $_key=>$_var) {
            //include 'data://,' . $_code;
            eval('?>' . $_code);
        }
    }
    function __call($func, $param) {
        if(function_exists($func)) return call_user_func_array($func, $param);
        return array();
    }
    function __toString() {
        return join('<', $this->data);
    }
}
