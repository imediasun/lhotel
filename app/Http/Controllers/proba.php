<?
//на новом итераторе 0 0 0
if(!empty(session($process))){
$cnt=count(session($process));

}
else{
$cnt=0;
}



/* foreach(session($process) as $proc){

$cnt+=count($proc);
}*/
if($cnt==0){
$c=0;
}
else{
$c=$cnt;

}
dump(session($process));
dump($c);
dump($imag);
//если есть file_name запускаем для каждого и в последний записываем
for($i=0;$i<1;$i++) {
if (session()->has($process . '.' . $c . '.image_medium')) {
session()->put($process . '.' . $c . '.image_large', $imag);
/*     $sess_array=session($process);
$last_key = key( array_slice( $sess_array, -1, 1, TRUE ) );*/
break;
}
if (session()->has($process . '.' . $c . '.image_small')) {
session()->put($process . '.' . $c . '.image_medium', $imag);

break;
} else {

session([$process . '.' . $c . '.image_small' => $imag]);
break;
}
}