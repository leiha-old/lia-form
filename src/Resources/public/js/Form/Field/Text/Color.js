/**
 * @class   Form.Field.Color
 * @author  leiha
 * @extends $lia.Form.Field.Text
 *
 */
$lia.Form.Field.Color = $lia.Class.create(
    [$lia.Form.Field.Text],
{
    /**
     * @protected
     */
    build : function(){
        this._parent.build.apply(this, [])
            .colorpicker(this.config)
        ;
    }
});