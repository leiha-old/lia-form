/**
 * @class
 * @author leiha
 */
$lia.Form.Field = $lia.Class.create({

    /**
     * @property
     */
    config : {},

    /**
     * @protected
     */
    settingUp : function(){
        this.config = {
            name  : '',
            label : '',
            node  : null,
            attr  : {},
            css   : {}
        };
    },

    /**
     * @protected
     * @constructor
     */
    init : function(name, config){
        if(!$.isPlainObject(config)){
            config = {};
        }
        if($.isPlainObject(name)){
            config = name;name = '';
        } else if(name){
            config.name = name;
        }
        $.extend(this.config, config);

        //this.__merge('config', config);
    },

    setValue : function(value){
        this.getNode().val(value);
        return this;
    },

    getName : function(){
        return this.config.name;
    },

    getValue : function(){
        return this.getNode().val();
    },

    data : function(name, value){
        if(arguments.length == 2){
            this.getNode().data(name, value);
        }
        else{
            return this.getNode().data(name);
        }

        return this;
    },

    getNode : function(){
        if(!this.node)
            this.initNode();

        return this.node;
    },

    initNode : function(){
        this.node = $(this.config.node);
        this.node.data('factory', this)
    },

    event : function(name, callback){
      this.getNode()[name](callback);
      return this;
    },

    /**
     * @public
     */
    render : function(){
        return this.build()
            .css(this.config.css)
            .attr(this.config.attr)
            ;
    },

    /**
     * @description Can (Must ?) be overloaded
     * @protected
     * @return $(node)
     */
    build : function(){
        return this.getNode()
            .addClass('lia-form-field')
            ;
    }
});