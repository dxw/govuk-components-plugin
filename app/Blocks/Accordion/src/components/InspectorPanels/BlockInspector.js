import { InspectorControls } from '@wordpress/block-editor';
import UsagePanel from './UsagePanel';

export default function BlockInspector() {
    return (
        <InspectorControls>
            <UsagePanel/>
        </InspectorControls>
    )
}