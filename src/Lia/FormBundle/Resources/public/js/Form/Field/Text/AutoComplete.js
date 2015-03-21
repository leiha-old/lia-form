/**
 * @class   Form.Field.AutoComplete
 * @author  leiha
 * @extends $lia.Form.Field.Text
 *
 */
$lia.Form.Field.AutoComplete = $lia.Class.create(
    [$lia.Form.Field.Text],
{
    /**
     * @protected
     */
    build : function(){
        this._parent.build.apply(this, [])
            .autocomplete(this.config)
        ;
    }
});