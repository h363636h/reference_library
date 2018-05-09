
function getTime(opt) {
//   minsec = opt.value.split(':');
//   console.log(minsec);
  return parseFloat(opt);
}

var curScene = StartScene;
var curSceneStart = getTime(StartScene);
var curSceneEnd = getTime(SecondScene);

function CheckForScene(pos) {
  if( curSceneStart <= pos && pos <= curSceneEnd ) return;
  curSceneEnd = 0; nextscene = scene = null; 
  for(sno in Scenes.childNodes) { cn = Scenes.childNodes[sno]; if(cn.tagName=="OPTION") {
    scene = nextscene; nextscene = Scenes.childNodes[sno]; 
    curSceneStart = curSceneEnd; curSceneEnd = getTime(nextscene);
    if( curSceneStart <= pos && pos < curSceneEnd && scene ) {
      scene.selected = true;
      return;
    }
  }}
  curSceneStart = curSceneEnd; curSceneEnd = ReiherVideo.duration; scene = nextscene; 
  if( curSceneStart <= pos && pos <= curSceneEnd && scene ) scene.selected = true;
}

var inited = false;

function InitControls(video) {
  if(inited) return;
  videopos.max = video.duration - 1;
  videopos.style.width = video.videoWidth;  // video.offsetWidth || video.innerWidth; 
  StartScene.selected = true;
  inited = true;
}

var ratedelta = 0;
var buttons = [ 'playbutton','fstbwdbut','fstfwdbut','snailbut' ];
var savedicon = {};

function PlayPause(video,but,rate) {
  if (video.paused||video.playbackRate + ratedelta != rate) PlayVideo(video,but,rate); else PauseVideo(video); 
  
}

function RestoreButtons() {
  for(butno in buttons) { but_id = buttons[butno]; but = document.getElementById(but_id);
    if(but_id in savedicon) but.value = savedicon[but_id]; }
}

function PlayVideo(video,but,rate) {
  if(video.paused) video.play(); 
  video.playbackRate = rate; 
  ratedelta = rate - video.playbackRate;
  RestoreButtons();
  if(!(but.id in savedicon)) savedicon[but.id] = but.value;
  but.value = String.fromCharCode('0x25AE','0x25AE');

 play_currentTime = video.currentTime.toFixed(2);
}

function PauseVideo(video) {
  video.pause(); RestoreButtons();

  pause_currentTime = video.currentTime;

  var play_con_time = new Date(null);	//초 단위 -> 분 단위 
  play_con_time.setSeconds(play_currentTime);

  var pause_con_time = new Date(null);	//초 단위 -> 분 단위 
  pause_con_time.setSeconds(pause_currentTime);
    
  view_play_currentTime = play_con_time.toISOString().substr(11,8);
  view_pause_currentTime = pause_con_time.toISOString().substr(11,8);
  
  vid_interval = view_play_currentTime + "~" + view_pause_currentTime ;
//   alert(vid_interval);

  var option = document.createElement("option");
  option.text = vid_interval ;
  option.value =   play_currentTime  ; //선택 시, 해당 시간에 해당하는 영상 재생
  var select = document.getElementById("Scenes");
  select.appendChild(option);
}

function FrameStep(video,but,step) {
  PauseVideo(video);
  video.currentTime =  video.currentTime + step;
  UpdateTime(video);
}

function RewindVideo(video) {
  PauseVideo(video);
  video.currentTime =  0;
  UpdateTime(video);
}

function UpdateTime(video) {
  videopos.value = video.currentTime; CheckForScene(video.currentTime);
  }

function GotoPos(video,newpos) {
  video.currentTime = newpos; CheckForScene(newpos); }

function SelectScene(video,selector) {
  minsec = selector.value;
//   console.log(minsec);
  video.currentTime = selector.value;
  UpdateTime(video);
}

function Mute(video,but) {
  video.muted = !video.muted;
  but.style.color = video.muted ? 'silver' : 'black';
}

function AdjustVolume(video,value) {
  video.volume = value;
  VolumeTxt.innerHTML = Math.round(value*100)+'%'
}