/**
 * @author  leiha
 * @extends $lia.Form.Field.Text
 *
 */
$lia.Form.Field.Date = $lia.Class.create(
    [$lia.Form.Field.Text],
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

    /**
     * @protected
     * @constructor
     */
    init : function(name, config){
        $.extend(this.config, {
            calendar : {}
        });
        this._parent.init.apply(this, arguments);
    },

    /**
     * @protected
     */
    build : function(){
        this._parent.build.apply(this, [])
            .datepicker(this.config)
        ;
    }
});