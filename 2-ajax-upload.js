var ajaxup = {
  // (A) ADD TO UPLOAD QUEUE
  queue : [], // upload queue
  add : function () { 
    for (let f of document.getElementById("upfile").files) {
      ajaxup.queue.push(f);
    }
    document.getElementById("upform").reset();
    if (!ajaxup.uploading) { ajaxup.go(); }
    return false;
  },
  
  // (B) AJAX UPLOAD
  uploading : false, // upload in progress
  go : function () { 
    // (B1) UPLOAD ALREADY IN PROGRESS
    ajaxup.uploading = true;
    
    // (B2) FILE TO UPLOAD
    var data = new FormData();
    data.append("upfile", ajaxup.queue[0]);
    // APPEND MORE VARIABLES IF YOU WANT
    // data.append("KEY", "VALUE");

    // (B3) AJAX REQUEST
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "3-ajax-upload.php");
    xhr.onload = function(){
      // (B4) SHOW UPLOAD RESULTS

    var _size = ajaxup.queue[0].size;
    var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
    i=0;while(_size>900){_size/=1024;i++;}
    var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
      


      document.getElementById("upstat").innerHTML += 
      `<li class="fileslist__item">
      <span class="fileslist__left">
        <span class="fileslist__name">${ajaxup.queue[0].name}</span>
        <span class="fileslist__size">${exactSize}</span>
      </span>
      <span class="fileslist__right">
      <span class="fileslist__resize"></span>
      <span class="fileslist__result">${this.response}</span>
      </span>
      </li>`;
      
      // (B5) NEXT FILE
      ajaxup.queue.shift();
      if (ajaxup.queue.length!=0) { ajaxup.go(); }
      else { ajaxup.uploading = false; }
    };

    // (B6) GO!
    xhr.send(data);

        document.getElementById("cont-downloadAll").innerHTML = `<button class="downloadAll btn_main">Скачать все архивом ZIP</button>`;

  }
};

var ajaxup2 = {
  // (A) ADD TO UPLOAD QUEUE
  queue : [], // upload queue
  add : function () { 
    for (let f of document.getElementById("upfile2").files) {
      ajaxup2.queue.push(f);
    }
    document.getElementById("upform2").reset();
    if (!ajaxup2.uploading) { ajaxup2.go(); }
    return false;
  },
  
  // (B) AJAX UPLOAD
  uploading : false, // upload in progress
  go : function () { 
    // (B1) UPLOAD ALREADY IN PROGRESS
    ajaxup2.uploading = true;
    
    // (B2) FILE TO UPLOAD
    var data = new FormData();
    data.append("upfile2", ajaxup2.queue[0]);
    // APPEND MORE VARIABLES IF YOU WANT
    // data.append("KEY", "VALUE");

    // (B3) AJAX REQUEST
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "3-ajax-upload2.php");
    xhr.onload = function(){
      // (B4) SHOW UPLOAD RESULTS
      document.getElementById("upstat2").innerHTML += `<div>${ajaxup2.queue[0].name} - ${this.response}</div>`;
      
      // (B5) NEXT FILE
      ajaxup2.queue.shift();
      if (ajaxup2.queue.length!=0) { ajaxup2.go(); }
      else { ajaxup2.uploading = false; }
    };

      

    

    // (B6) GO!
    xhr.send(data);
  }
};