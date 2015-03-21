/**
 * @author  leiha
 * @extends $lia.Form.Field
 *
 */
$lia.Form.Field.Checkbox = $lia.Class.create(
    [$lia.Form.Field],
{
    /**
     * @protected
     */
    settingUp : function(){
        this.config = {
            name    : '',
            label   : '',
            node    : '<input type="checkbox" />',
            attr    : {},
            css     : {},
            value   : ''
        };
    },

    check : function(enable){
        this.getNode().prop('checked', enable);
        this.config.attr['checked'] = enable;
        return this;
    },

    isChecked : function(){
        return this.getNode().is(':checked');
    }
});