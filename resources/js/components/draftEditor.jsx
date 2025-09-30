    // resources/js/components/DraftEditor.jsx
    import React, { useState } from 'react';
    // import { Editor, EditorState } from 'draft-js';
    // import 'draft-js/dist/Draft.css'; // Import Draft.js styles

    function DraftEditor() {
        const [editorState, setEditorState] = useState(EditorState.createEmpty());

        const onChange = (newEditorState) => {
            setEditorState(newEditorState);
        };

        return (
            <div style={{ border: '1px solid #ccc', minHeight: '150px', padding: '10px' }}>
                <Editor editorState={editorState} onChange={onChange} placeholder="Tell a story..." />
            </div>
        );
    }

    export default DraftEditor;