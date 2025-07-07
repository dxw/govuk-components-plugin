import Edit from './edit';
import Save from './save';
import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';

registerBlockType(metadata.name, {
	edit: Edit,
	save: Save,
});
