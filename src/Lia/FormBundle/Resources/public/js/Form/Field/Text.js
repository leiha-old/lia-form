/**
 * @author  leiha
 * @extends $lia.Form.Field
 *
 */
$lia.Form.Field.Text = $lia.Class.create(
    [$lia.Form.Field],
{
    /**
     * @protected
     */
    settingUp : function(){
        this.config = {
            name    : '',
            label   : '',
            node    : '<input type="text" />',
            length  : null,
            attr    : {},
            css     : {},
            value   : ''
        };
    },

    init : function (name, config) {
        this._parent.init.apply(this, [name, config]);
        this.getNode()
            .addClass('lia-form-field-text')
        ;

        if(this.config.length){
            this.getNode().attr("maxlength", this.config.length);
        }
    }
});