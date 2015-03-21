/**
 * @author  leiha
 * @extends $lia.Form.Field
 *
 */
$lia.Form.Field.Radio = $lia.Class.create(
    [$lia.Form.Field],
{

    /**
     * @protected
     */
    settingUp : function(){
        this.config = {
            name    : '',
            label   : '',
            node    : '<input type="radio" />',
            attr    : {},
            css     : {},
            value   : ''
        };
    }
});