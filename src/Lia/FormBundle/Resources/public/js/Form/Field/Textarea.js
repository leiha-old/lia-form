/**
 * @author  leiha
 * @extends $lia.Form.Field
 *
 */
$lia.Form.Field.Textarea = $lia.Class.create(
    [$lia.Form.Field],
{
    /**
     * @protected
     */
    settingUp : function(){
        this.config = {
            name    : '',
            label   : '',
            node    : '<textarea></textarea>',
            attr    : {},
            css     : {},
            value   : ''
        };
    }
});