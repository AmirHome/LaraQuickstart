<?php
use Illuminate\Http\JsonResponse;
use App\Sites;

#### Result Compacted Variables ####
function viewAmirHome($view, $data)
{
    if (isset($_GET['debug']) && 1 == $_GET['debug']) {
        # for debug by amir hosseinzadeh
        echo '<pre>'.$view.'.blade.php</pre>'; 
        echo '<pre>'.getCurrentMethod().'</pre>'; 
        dd([ collect($data)->toarray() ]);
    }
    return view($view, $data);
}

function getCurrentMethod()
{
   // return explode("@",class_basename(app('request')->route()->getAction()['controller']))[1];
   return class_basename(app('request')->route()->getAction()['controller']);
}

function configCKeditor(array $textareaIds)
{
    $ret = '';
    $lang = App::getLocale();
    $url = url('/');
    $csrf_token = csrf_token();
    foreach ($textareaIds as $textarea) {
        $ret .=
"CKEDITOR.replace( '$textarea', {
    language: '$lang',
    allowedContent: true,
    autoParagraph: false,
    filebrowserImageBrowseUrl: '$url/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '$url/laravel-filemanager/upload?type=Images&_token=$csrf_token',
    filebrowserBrowseUrl: '$url/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '$url/laravel-filemanager/upload?type=Files&_token=$csrf_token',
    extraPlugins: 'layoutmanager'
});"
                ;
    }
    return $ret;
}

function setLang($lang)
{
    if (in_array($lang, config('app.locales'))) {

        session()->put('locale', $lang);

    }elseif (!session('locale')) {

        session()->put('locale', config('app.locale'));
    }

    app()->setLocale(session('locale'));
}

function getDomain($domain = null){

        // $domain = 'http://yeditepeekspertiz.com/';
        // $domain = 'http://www.absyeditepe.com/';
        // $domain = 'http://arafgida.com/';
        // $domain = 'http://yeditepe.smartme.com.tr/yapisalcozumler';
        // $domain = 'http://www.broadwell.com.tr/';
        // $domain = 'http://www.yeditepegroup.com/';
        // $domain = 'http://www.yeditepeentertainment.com/';

        $domain = strtolower($domain);
        if (empty($domain)) {
            $domain = url('/');
        }
        
        if (isset(parse_url($domain)['host'])) {
            $domain = parse_url($domain)['host'];
        }

/*        if ( 'localhost' == $domain ){
            $domain = \Request::segment(1) ;
            $last_word_start = strrpos(url('/'), '/') + 1;
            $domain = substr(url('/'), $last_word_start); 
        }*/

        if (starts_with( $domain, 'www.')){
            $domain = substr($domain, 4);

        }

        if ($tmp = strstr( $domain , '.', true)) {
            $domain = $tmp;
        };

        return $domain;
}

function getSiteId ($domain){

    $domain = getDomain(strtolower($domain));
    $locale = \App::getLocale();
    $domain = Sites::where('title', $domain.'-'.$locale)->firstOrFail();

    return $domain->id;
}

function getSites (){

    $sites = Sites::select('title', 'id')->get();

    return $sites;
}

function chosenSiteTitle (){
    return chosenSite()['title'];
}

function chosenSiteId (){
    return chosenSite()['id'];
}

function chosenSite(){

    if ( !($site = Session::get('siteLanguage')) ) {

        $site = Sites::select('title', 'id')->first();
        session()->put('siteLanguage', [ 'id'=>$site->id, 'title'=>$site->title ]);
    }

    return $site;
}

function reverseLocate(){

    $locales = ['tr','en'];
    if(!session('locale'))
    {
        $del_val = 'tr';
    }
    else{
        $del_val = session('locale');
    }

    if (($key = array_search($del_val, $locales)) !== false) {
        unset($locales[$key]);
    }

    return array_pop($locales);

}

function getControllerName()
{
    $ret  = app('request')->route()->getAction();
    $ret  = class_basename($ret['controller']);
    $ret  = explode('@', $ret);
    return strtolower(str_replace('Controller', '/', $ret[0]));

}

function getRowByCol($rows, $value, $field='slug')
{
   foreach($rows as $key => $row)
   {
      if ( $row[$field] === $value )
         return $rows[$key];
   }
   return false;
}

function number2Word($index)
{
    $words = [0 => 'first',1 => 'second', 2 => 'third', 3 => 'fourth',];
    return $words[$index];
}

function cleanUrl($url)
{
    // $url = 'http://yapisalcozumler.local/';
    // $url = 'http://yapisalcozumler.local/#tabs';

    $pcUrl = url()->current();
    // $pcUrl = 'http://yapisalcozumler.local/#tabs';
    // $pcUrl = 'http://yapisalcozumler.local/25/page/?debug';
    

    $pcUrl = parse_url($pcUrl);
    $url = trim($url, '/');
    $pUrl = parse_url($url);

    if (isset($pUrl['host'])) {

        $pPath = ($pUrl['path']??'');
        $pUrl = trim($pUrl['host']. $pPath, '/');
        
        $pcUrl = trim($pcUrl['host'].($pcUrl['path']??''), '/');

        if( $pUrl == $pcUrl ){
            if ($pPath) {

                $url = trim(substr($url,strlen($url) - (strpos($url,'/'))),'/');
            }else{
                $url = '/';
            }
        }
    }

    // dd([$pcUrl, $pUrl, $url]);
    return $url;
}

function classActive($str1, $str2, $output = 'active')
{

    if ($str1 == $str2) {
        return $output;
    }
}

// @if(Request::path() == config('quickadmin.route').'/menu') class="active" @endif
// @if(Request::path() == 'users') class="active" @endif
// @if(Request::path() == 'roles') class="active" @endif
// @if(Request::path() == config('quickadmin.route').'/actions') class="active" @endif
// @if(isset(explode('/',Request::path())[1]) && explode('/',Request::path())[1] == strtolower($menu->name)) class="active" @endif
// @if(isset(explode('/',Request::path())[1]) && explode('/',Request::path())[1] == strtolower($child->name)) class="active active-sub" @endif
function isActiveRoute($route, $output = 'active')
{
    if (starts_with($route,'/')) {
        $route = config('quickadmin.route').$route;
    }

    if ( strpos( Request::path(), strtolower($route)) !== false ) {
        return $output;
    }
}