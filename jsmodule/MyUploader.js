export default class MyUploader {
    constructor(loader) {
        this.loader = loader;
        
    }

    upload() {
        console.log("업로드 시작"); 
        return this.loader.file
            .then( file => new Promise( (res, rej)=>{
                this._initRequest();
                this._initListener(res, rej, file);
                this._sendRequest(file);
            }));
    }
    //요청 초기화
    _initRequest(){
        //AJAX 요청 셋팅
        const xhr = this.xhr = new XMLHttpRequest();
        xhr.open("POST", "/upload", true);
        xhr.responseType = 'json';
    }
    //데이터 전송 셋팅
    _initListener(res, rej, file){
        const genericErrorText = `다음 파일을 업로드 할 수 없습니다. : ${file.name}`;
        const xhr = this.xhr
        xhr.addEventListener('error', ()=>rej(genericErrorText));
        xhr.addEventListener('abort', ()=>rej());
        xhr.addEventListener('load', ()=>{
            const response = xhr.response;
            console.log(response);
            if(!response || response.error){
                return rej(response && response.error ? response.error.msg : genericErrorText);
            }

            res({
                default:response.url
            });
        });
    }

    //실제 전송
    _sendRequest(file){
        const data = new FormData();
        data.append("upload", file);
        this.xhr.send(data);
    }
}