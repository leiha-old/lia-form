/**
 * @author  leiha
 * @extends $lia.Form.Field
 *
 */
$lia.Form.Field.Select = $lia.Class.create(
    [$lia.Form.Field],
{
    /**
     * @protected
     */
    settingUp : function(){
        this.config = {
            /*
             * interval
             * - options : {start:nb, end:nb}
             */
            type    : '',
            name    : '',
            label   : '',
            node    : '<select></select>',
            attr    : {},
            css     : {},
            values  : {},
            options : {},
            keyValue: '',
            keyHtml : ''
        };
    },

    /*
    getValue : function(){
        return $('option:selected', this.getNode());
    },*/

    /**
     * @public
     */
    setType : function(type, config){
        this.config.type    = type;
        this.config.options = config;
        return this;
    },

    /**
     * @public
     */
    setOptions : function(options, keyValue, keyHtml){
        this.config.options = options;
        if(keyValue)
            this.config.keyValue = keyValue;
        if(keyHtml)
            this.config.keyHtml  = keyHtml;
        return this;
    },

    /**
     * @public
     */
    addValue : function(value){
        if($.isArray(this.config.values))
            this.config.values.push(value);
        else if($.isPlainObject(this.config.values))
            this.config.values[value] = value;
        else if($.isString(this.config.values))
            this.config.values = [this.config.values, value];
        else
            this.config.values = [value];
        return this;
    },

    /**
     * @public
     */
    getOptions : function(){
        switch(this.config.type){
            case 'interval' :
                return this.buildIntervalOptions();
                break;
            default :
                return this.config.options;
                break;
        }
    },

    /**
     * @protected
     */
    buildIntervalOptions : function(){
        if(!$.isDefined(this.config.options.end))
            throw new Error('Select Field ['+ this.config.name +'] need config.options.end for type [interval]');

        var options = {};
        var i = this.config.options.start ? this.config.options.start : 1;
        for(;i<= this.config.options.end;i++)
            options[i] = i;

        return options;
    },

    /**
     * @public
     */
    checkValue : function(value){
        var values = this.config.values;
        if($.isArray(values) || $.isPlainObject(values)){
            for(var i in values){
                if(values[i] == value)
                    return true;
            }
        } else{
            return values == value;
        }
    },

    /**
     * @protected
     */
    build : function(){
        var option     = null;
        var selectNode = this.getNode();
        var options = this.getOptions();
        $.forEach(options, function(option, i){
            var html  = this.config.keyHtml
                ? $.isFunction(option[this.config.keyHtml])
                    ? option[this.config.keyHtml]()
                    : option[this.config.keyHtml]
                : option;
            var value = this.config.keyValue
                ? $.isFunction(option[this.config.keyValue])
                    ? option[this.config.keyValue]()
                    : option[this.config.keyValue]
                : $.isArray(options)
                    ? option
                    : i
                ;

            option = $('<option></option>')
                .html(html)
                .val(value)
                .appendTo(selectNode)
            ;
            if(this.checkValue(value)){
                option.attr('selected', true)
            }
        }, this);

        return this._parent.build.apply(this, []);
    }
});