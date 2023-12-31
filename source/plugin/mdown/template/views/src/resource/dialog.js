define(function(require){
    /* generated by mengma @2020-01-07 10:43 */
    var WebImageField=require("common/WebImageField");
    var ResourceField=require("common/ResourceField");
    var dialogid = 'dialog-'+mwt.genId();
    var form,dialog,params,callback;
    
    function init_dialog() 
    {/*{{{*/
        //1. new form
        form = new MWT.Form();
        form.addField('cateid',new MWT.SelectField({
            render : 'fm-cateid'+dialogid,
            options : dict.getOptions("category"),
            value   : 1
        }));
        form.addField('title',new MWT.TextField({
            type        : 'text',
            render      : 'fm-title'+dialogid,
            value       : '', 
            placeholder : '',
            empty       : false,
            errmsg      : "请输入资源标题,不超过1024个字符",
            checkfun    : function(v){return v.length<=1024;}
        }));

        form.addField('size',new MWT.TextField({
            type        : 'text',
            render      : 'fm-size'+dialogid,
            value       : '', 
            placeholder : '',
            empty       : false,
            errmsg      : "请输入资源大小,不超过1024个字符",
            checkfun    : function(v){return v.length<=1024;}
        }));
        /*form.addField('icon',new MWT.TextField({
            type        : 'text',
            render      : 'fm-icon'+dialogid,
            value       : '', 
            placeholder : '',
            empty       : false,
            errmsg      : "请输入图标链接,不超过1024个字符",
            checkfun    : function(v){return v.length<=1024;}
        }));*/
        form.addField('icon',new WebImageField({
            render : 'fm-icon'+dialogid,
            value  : dz.defaultIcon,
            empty  : false,
            errmsg : '请输入图片'
        }));
        form.addField('url',new ResourceField({
            render : 'fm-url'+dialogid,
            value  : '',
            empty  : false,
            errmsg : '请上传资源'
        }));
        /*form.addField('url',new MWT.TextField({
            type        : 'text',
            render      : 'fm-url'+dialogid,
            value       : '', 
            placeholder : '',
            empty       : false,
            errmsg      : "请输入资源链接,不超过1024个字符",
            checkfun    : function(v){return v.length<=1024;}
        }));*/


        /*form.addField('urltype',new MWT.RadioField({
            render : 'fm-urltype'+dialogid,
            options : [{text:'开启',value:1},{text:"关闭",value:0}],
            value   : 1,
            errmsg  : '请选择',
            empty   : false
        }));*/
        // form.addField('credits',new MWT.TextField({
        //     type        : 'number',
        //     render      : 'fm-credits'+dialogid,
        //     value       : '0',
        //     placeholder : '请输入资源所需积分',
        //     empty       : false,
        //     errmsg      : "请输入资源所需积分,不超过1024个字符",
        //     checkfun    : function(v){return v.length<=1024;}
        // }));
        form.addField('info',new MWT.TextField({
            type        : 'textarea',
            style       : 'height:200px',
            render      : 'fm-info'+dialogid,
            value       : '',
            placeholder : '',
            empty       : false,
            errmsg      : "请输入介绍(支持markdown),不超过1024个字符",
            checkfun    : function(v){return v.length<=1024;}
        }));

        //2. new dialog
        dialog = new MWT.Dialog({
            title     : '对话框',
            form      : form,
            fullscreen: true,
            animate   : 'slideRight',
            style     : 'left:50%;right:0',
            bodyStyle : 'padding:10px;',
            body : '<table class="mwt-formtab">'+
               '<tr>'+
                 '<td width="100">分类 <b style="color:red">*</b></td>'+
                 '<td><div id="fm-cateid'+dialogid+'"></div></td>'+
                 '<td width="100" class="tips"></td>'+
               '</tr>'+
               '<tr>'+
                 '<td>图标链接 <b style="color:red">*</b></td>'+
                 '<td><div id="fm-icon'+dialogid+'"></div></td>'+
                 '<td class="tips"></td>'+
               '</tr>'+
               '<tr>'+
                 '<td>资源标题 <b style="color:red">*</b></td>'+
                 '<td><div id="fm-title'+dialogid+'"></div></td>'+
                 '<td class="tips"></td>'+
               '</tr>'+
               '<tr>'+
                 '<td>资源大小 <b style="color:red">*</b></td>'+
                 '<td><div id="fm-size'+dialogid+'"></div></td>'+
                 '<td class="tips"></td>'+
               '</tr>'+
               '<tr>'+
                 '<td>资源链接 <b style="color:red">*</b></td>'+
                 '<td><div id="fm-url'+dialogid+'"></div></td>'+
                 '<td class="tips"></td>'+
               '</tr>'+
               /*'<tr>'+
                 '<td>链接类型(1:下载链接;2:跳转链接) <b style="color:red">*</b></td>'+
                 '<td><div id="fm-urltype'+dialogid+'"></div></td>'+
                 '<td class="tips"></td>'+
               '</tr>'+*/
               /*'<tr>'+
                 '<td>资源所需积分 <b style="color:red">*</b></td>'+
                 '<td><div id="fm-credits'+dialogid+'"></div></td>'+
                 '<td class="tips"></td>'+
               '</tr>'+*/
               '<tr>'+
                 '<td>介绍<b style="color:red">*</b></td>'+
                 '<td><div id="fm-info'+dialogid+'"></div></td>'+
                 '<td class="tips"></td>'+
               '</tr>'+
            '</table>',
            buttons : [
                {label:"确定",cls:'mwt-btn-primary',handler:submitClick},
                {label:"取消",type:'close',cls:'mwt-btn-default'}
            ]
        });
        //3. dialog open event
        dialog.on('open',function(){
            form.reset();
            if (params.id) {
                dialog.setTitle("编辑资源");
                form.set(params);
            } else {
                dialog.setTitle("新增资源");
            }
        });
    }/*}}}*/

    var o={};
    o.open=function(_params,_callback){
        params   = _params;
        callback = _callback;
        if (!dialog) init_dialog();
        dialog.open();
    };  

    /////////////////////////////////////
    // 提交按钮点击事件
    function submitClick() {
        var data = form.getData();
        try {
            data.id = params.id;
            data.info = dz_post_encode(data.info);
            data.title = dz_post_encode(data.title);
            ajax.post('saveResource',data,function(res){
                if (res.retcode!=0) mwt.notify(res.retmsg,1500,'danger');
                else {
                    dialog.close();
                    if (callback) callback();
                }   
            }); 
        } catch (e) {
            mwt.notify(e,1500,'danger');
        }
    }

    return o;
});
