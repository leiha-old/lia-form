/**
 * @class   Form.Field.Wysiwyg
 * @author  leiha
 * @extends $lia.Form.Field.Textarea
 *
 */
$lia.Form.Field.Wysiwyg = $lia.Class.create(
    [$lia.Form.Field.Textarea],
{
    /**
     * @protected
     */
    build : function(){
        this._parent.build.apply(this, [])
            .ckeditor(this.config)
        ;
    }
});