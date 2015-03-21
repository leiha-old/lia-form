/**
 * @author  leiha
 * @extends $lia.Form.Field
 *
 */
$lia.Form.Field.File = $lia.Class.create(
    [$lia.Form.Field],
{

    /**
     * @protected
     */
    settingUp : function(){
        this.config = {
            name    : '',
            label   : '',
            node    : '<input type="file" />',
            attr    : {},
            css     : {},
            value   : ''
        };
    }
});