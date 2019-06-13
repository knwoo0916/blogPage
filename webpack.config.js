const path = require('path');

module.exports = {
    mode:"development",
    entry:{
        app: "./index.js",
        editor: "./editor.js"
    },
    output:{
        "path":path.join(__dirname, "/public/js")
    },
    module:{
        rules:[
            {
                test:/\.css$/,
                use:['style-loader', 'css-loader']
            }
        ]
    }
}