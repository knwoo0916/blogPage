import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import '@ckeditor/ckeditor5-build-classic/build/translations/ko';
import MyUploader from './MyUploader';

export default class Editor{
    constructor(){
        this.textarea = document.querySelector("#editor");
        let option = {
            toolbar:['heading', 'undo', 'redo', '|', 
                    'bold', 'italic', 'link', '|',
                    'imageUpload'
            ],
            heading:{
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' }
                ]
            },
            language:"ko"
        }
        ClassicEditor.create(this.textarea, option)
        .then( ck => {
            let list = Array.from(ck.ui.componentFactory.names());
            console.log(list);

            ck.plugins.get('FileRepository').createUploadAdapter 
                = (loader) => new MyUploader(loader);
        }).catch( err => {
            console.log(err);
        })
    }
}
