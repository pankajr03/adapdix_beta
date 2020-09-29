(function() {
    tinymce.PluginManager.add('GSTEAM_mce_button', function( editor, url ) {
        editor.addButton( 'GSTEAM_mce_button', {
            title: 'GS Team Members',
            type: 'button',
            icon: 'icon gsteammembers-mce-icon',
            onclick: function() {
                editor.windowManager.open( {
                    title: 'Insert GS Team Members Shortcode ',
                    body: [{
                        type: 'textbox',
                        name: 'TotMembers',
                        label: 'Number of Members',
                        value:'10'
                    },
                    {
                        type: 'listbox', 
                        name: 'GSTeamTheme', 
                        label: 'Theme', 
                        'values': [
                            {text: 'Theme 1 (Hover)', value: 'gs_tm_theme1'},
                            {text: 'Theme 2 (Round)', value: 'gs_tm_theme2'},
                            
/* Premium Code Stripped by Freemius */
                         
                        ]
                    },
                    {
                        type: 'listbox', 
                        name: 'GSTeamCol', 
                        label: 'Column', 
                        'values': [
                            {text: '4 Columns', value: '3'},
                            {text: '2 Columns', value: '6'},                        
                            {text: '3 Columns', value: '4'}
                        ]
                    },
                    {
                        type: 'textbox',
                        name: 'GSTeamGrp',
                        label: 'Team Group / Category',
                        placeholder:'Add Category Slug'
                    },
                    {
                        type: 'listbox', 
                        name: 'TeamCatN', 
                        label: 'Category Name show/hide', 
                        'values': [
                            {text: 'None', value: 'none'},
                            {text: 'Initial', value: 'initial'}
                        ]
                    },
                    {
                        type: 'listbox', 
                        name: 'TeamOrder', 
                        label: 'Order', 
                        'values': [
                            {text: 'DESC', value: 'DESC'},
                            {text: 'ASC', value: 'ASC'}
                        ]
                    },
                    {
                        type: 'listbox', 
                        name: 'TeamOrderBy', 
                        label: 'Order By', 
                        'values': [
                            {text: 'Date', value: 'date'},
                            {text: 'ID', value: 'ID'},
                            {text: 'Title', value: 'title'},
                            {text: 'Modified', value: 'modified'},
                            {text: 'Random', value: 'rand'}
                        ]
                    }

                    ],
                    onsubmit: function( e ) {
                        editor.insertContent('[gs_team num="' + e.data.TotMembers + '" theme="' + e.data.GSTeamTheme + '" cols="' + e.data.GSTeamCol + '" group="' + e.data.GSTeamGrp + '" cats_name="' + e.data.TeamCatN + '" order="' + e.data.TeamOrder + '" orderby="' + e.data.TeamOrderBy + '"]');
                    }

                });
    }
        });
    });
})();



