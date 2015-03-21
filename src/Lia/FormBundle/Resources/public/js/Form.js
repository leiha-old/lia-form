/**
 * @class
 * @author leiha
 *
 */
$lia.Form = $lia.Class.create({
    /** @private */
    settingUp : function(){
        /** @private */
        this.template = '<form>{{ content }}</form>';
        /** @private */
        this.node     = null;
        this.fields   = {};
        this.config   = {
            name      : '',
            container : 'BODY',
            template  : ''
        };
    },

    /**
     * @constructor
     * @private
     */
    init : function(name, config){
        if($.isPlainObject(name)){
            config = name;name = '';
        } else {
            config.name = name;
        }

        this.initNode();
    },

    /** @private */
    initNode : function(){
        var node = $(this.config.template);
        if(!node.length)
            node = $(this.template);

        this.node = node;
    },

    /** */
    getName : function(){
        if(this.config.name)
            return this.config.name;
    },

    /**  */
    getField : function(name){
        if(!this.fields[name]){
            var formName = this.getName();
            throw new Error('[Form'
                + (formName ? ' ->'+ formName : '')
                +'] field [ '+ name +' ] doesn\'t exist !'
            );
        }
        return this.fields[name];
    },

    /**  */
    addField : function(type, name, config){
        this.fields[name] = this._factory.field(type, name, config);
        return this;
    }
});
/**
 * @static
 */
$lia.Form.field = function(type, name, config){
    var className = type.capitalize();
    if(!this.Field[className])
        throw new Error('[Form] type [ '+ type +' ] doesn\'t exist !');

    return new this.Field[className](name, config);
};