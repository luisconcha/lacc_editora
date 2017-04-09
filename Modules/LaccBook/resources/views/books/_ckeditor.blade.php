@push('scripts')
<script src="/js/ckeditor/ckeditor.js"></script>

<script type="text/javascript">

    generateCkeditor( 'dedication' );
    generateCkeditor( 'description' );

    function generateCkeditor( idTextArea ) {
        CKEDITOR.replace( idTextArea, {
            toolbarGroups: [
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                { name: 'editing', groups: [ 'selection', 'spellchecker' ] },
                { name: 'links' },
                { name: 'others' },
                { name: 'colors' },
                { name: 'about' }
            ],
            removeButtons: 'Underline,Subscript,Superscript',
            extraPlugins: 'markdown',
            format_tags: 'p;h1;h2;h3;pre',
            removeDialogTabs: 'image:advanced;link:advanced',
        } );
    }


</script>
@endpush