import type { Config } from 'tailwindcss';

import colors from 'tailwindcss/colors';
import defaultTheme, { borderRadius, spacing } from 'tailwindcss/defaultTheme';
import plugin from 'tailwindcss/plugin';
import svgToDataUri from 'mini-svg-data-uri';


export default {
	darkMode: "selector",
	content: [
		'./views/**/*.{php,html}',
		'./components/**/*.php',
		'./partials/**/*.{php,html}',
		'./src/**/*.{js,ts}',
		"./node_modules/flowbite/**/*.js"
	],
	theme: {
		extend: {
			colors: {
				primary: colors.indigo,
				success: colors.emerald,
				gray: colors.zinc
			}
		},
	},
	plugins: [
		require('flowbite/plugin'),
		plugin(function ({ addComponents, theme, }) {
			addComponents({
				'.datatable-wrapper': {
					width: '100%',
				},
				'.datatable-wrapper .datatable-top': {
					display: 'flex',
					justifyContent: 'space-between',
					flexDirection: 'column-reverse',
					alignItems: 'start',
					gap: `${theme('spacing.4', spacing[4])}`,
					marginBottom: `${theme('spacing.4', spacing[4])}`,
				},
				'.datatable-wrapper .datatable-search .datatable-input, .datatable-wrapper .datatable-input':
				{
					color: `${theme(
						'colors.gray.900',
						colors.gray[900]
					)}`,
					fontSize: `${theme(
						'fontSize.sm',
						defaultTheme.fontSize.sm
					)}`,
					border: `1px solid ${theme('colors.gray.300')}`,
					borderRadius: `${theme(
						'borderRadius.lg',
						borderRadius.lg
					)}`,
					backgroundColor: `${theme(
						'colors.gray.50',
						colors.gray[50]
					)}`,
					minWidth: '16rem',
				},
				'.dark .datatable-wrapper .datatable-search .datatable-input, .dark .datatable-wrapper .datatable-input':
				{
					color: 'white',
					backgroundColor: `${theme(
						'colors.gray.900',
						colors.gray[900]
					)}`,
					backgroundOpacity: "0.6",
					border: `1px solid ${theme(
						'colors.gray.900',
						colors.gray[900]
					)}`,
				},
				'.datatable-wrapper thead th .datatable-input': {
					backgroundColor: 'white',
					fontWeight: `${theme('fontWeight.normal')}`,
					color: `${theme('colors.gray.900', colors.gray[900])}`,
					paddingTop: `.35rem`,
					paddingBottom: `.35rem`,
					minWidth: '0',
				},
				'.dark .datatable-wrapper thead th .datatable-input': {
					backgroundColor: `${theme(
						'colors.gray.700',
						colors.gray[700]
					)}`,
					borderColor: `${theme(
						'colors.gray.600',
						colors.gray[600]
					)}`,
					color: 'white',
				},
				'.datatable-wrapper .datatable-top .datatable-dropdown': {
					color: `${theme('colors.gray.500', colors.gray[500])}`,
					fontSize: `${theme(
						'fontSize.sm',
						defaultTheme.fontSize.sm
					)}`,
				},
				'.dark .datatable-wrapper .datatable-top .datatable-dropdown':
				{
					color: `${theme(
						'colors.gray.400',
						colors.gray[400]
					)}`,
				},
				'.datatable-wrapper .datatable-top .datatable-dropdown .datatable-selector':
				{
					backgroundColor: `${theme('colors.gray.50')}`,
					color: `${theme(
						'colors.gray.900',
						colors.gray[900]
					)}`,
					fontSize: `${theme(
						'fontSize.sm',
						defaultTheme.fontSize.sm
					)}`,
					border: `1px solid ${theme('colors.gray.300')}`,
					borderRadius: `${theme(
						'borderRadius.lg',
						borderRadius.lg
					)}`,
					marginRight: `${theme('spacing.1', spacing[1])}`,
					minWidth: '4rem',
				},
				'.dark .datatable-wrapper .datatable-top .datatable-dropdown .datatable-selector':
				{
					backgroundColor: `${theme(
						'colors.gray.900',
						colors.gray[900]
					)}`,
					backgroundOpacity: '.6',
					border: `1px solid ${theme(
						'colors.gray.900',
						colors.gray[900]
					)}`,
					color: 'white',
				},
				'.datatable-wrapper .datatable-container thead tr.search-filtering-row th':
				{
					paddingTop: '0',
				},
				'.datatable-wrapper .datatable-search .datatable-input:focus':
				{
					borderColor: `${theme(
						'colors.blue.600',
						colors.blue[600]
					)}`,
				},
				'.datatable-wrapper .datatable-container': {
					overflowX: 'auto',
				},
				'.datatable-wrapper .datatable-table': {
					width: '100%',
					fontSize: `${theme(
						'fontSize.sm',
						defaultTheme.fontSize.sm
					)}`,
					color: `${theme('colors.gray.500', colors.gray[500])}`,
					textAlign: 'left',
				},
				'.dark .datatable-wrapper .datatable-table': {
					color: `${theme('colors.gray.400', colors.gray[400])}`,
				},
				'.datatable-wrapper .datatable-table thead': {
					fontSize: `${theme(
						'fontSize.xs',
						defaultTheme.fontSize.xs
					)}`,
					color: `${theme('colors.gray.500', colors.gray[500])}`,
					backgroundColor: `${theme(
						'colors.gray.50',
						colors.gray[50]
					)}`,
				},
				'.dark .datatable-wrapper .datatable-table thead': {
					color: `${theme('colors.gray.400', colors.gray[400])}`,
					backgroundColor: `${theme(
						'colors.gray.900',
						colors.gray[900]
					)}`,
				},
				'.datatable-wrapper .datatable-table thead th': {
					whiteSpace: 'nowrap',
				},
				'.datatable-wrapper .datatable-table thead th, .datatable-wrapper .datatable-table tbody th, .datatable-wrapper .datatable-table tbody td':
				{
					width: 'auto !important',
					paddingTop: `${theme('spacing.3', spacing[3])}`,
					paddingBottom: `${theme('spacing.3', spacing[3])}`,
					paddingLeft: `${theme('spacing.6', spacing[6])}`,
					paddingRight: `${theme('spacing.6', spacing[6])}`,
				},
				'.datatable-wrapper .datatable-table thead th .datatable-sorter, .datatable-wrapper .datatable-table thead th':
				{
					textTransform: 'uppercase',
				},
				'.datatable-wrapper .datatable-table thead th .datatable-sorter:hover, .datatable-wrapper .datatable-table thead th.datatable-ascending .datatable-sorter, .datatable-wrapper .datatable-table thead th.datatable-descending .datatable-sorter':
				{
					color: `${theme(
						'colors.gray.900',
						colors.blue[900]
					)}`,
				},
				'.dark .datatable-wrapper .datatable-table thead th .datatable-sorter:hover, .dark .datatable-wrapper .datatable-table thead th.datatable-ascending .datatable-sorter, .dark .datatable-wrapper .datatable-table thead th.datatable-descending .datatable-sorter':
				{
					color: 'white',
				},
				'.datatable-wrapper .datatable-table tbody tr.selected': {
					backgroundColor: `${theme(
						'colors.gray.100',
						colors.gray[100]
					)}`,
				},
				'.dark .datatable-wrapper .datatable-table tbody tr.selected':
				{
					backgroundColor: `${theme(
						'colors.gray.700',
						colors.gray[700]
					)}`,
				},
				'.datatable-wrapper .datatable-table tbody tr': {
					borderBottom: `1px solid ${theme('colors.gray.200')}`,
				},
				'.dark .datatable-wrapper .datatable-table tbody tr': {
					borderBottom: `1px solid ${theme('colors.gray.900')}`,
				},
				'.datatable-wrapper .datatable-table .datatable-empty': {
					textAlign: 'center',
				},
				'.datatable-wrapper .datatable-bottom': {
					display: 'flex',
					flexDirection: 'column',
					justifyContent: 'space-between',
					alignItems: 'start',
					marginTop: `${theme('spacing.4', spacing[4])}`,
					gap: `${theme('spacing.4', spacing[4])}`,
				},
				'.datatable-wrapper .datatable-bottom .datatable-info': {
					color: `${theme('colors.gray.500', colors.gray[500])}`,
					fontSize: `${theme(
						'fontSize.sm',
						defaultTheme.fontSize.sm
					)}`,
				},
				'.dark .datatable-wrapper .datatable-bottom .datatable-info':
				{
					color: `${theme(
						'colors.gray.400',
						colors.gray[400]
					)}`,
				},
				'.datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list':
				{
					display: 'flex',
					alignItems: 'center',
					height: spacing[8],
					fontSize: `${theme(
						'fontSize.sm',
						defaultTheme.fontSize.sm
					)}`,
				},
				'.datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item-link':
				{
					display: 'flex',
					alignItems: 'center',
					color: `${theme(
						'colors.gray.500',
						colors.gray[500]
					)}`,
					fontWeight: `${theme('fontWeight.medium')}`,
					paddingLeft: `${theme('spacing.3', spacing[3])}`,
					paddingRight: `${theme('spacing.3', spacing[3])}`,
					height: spacing[8],
					fontSize: `${theme(
						'fontSize.sm',
						defaultTheme.fontSize.sm
					)}`,
					borderTop: `1px solid ${theme('colors.gray.300')}`,
					borderBottom: `1px solid ${theme(
						'colors.gray.300'
					)}`,
					borderRight: `1px solid ${theme(
						'colors.gray.300'
					)}`,
				},
				'.dark .datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item-link':
				{
					color: `${theme(
						'colors.gray.400',
						colors.gray[400]
					)}`,
					borderColor: `${theme(
						'colors.gray.700',
						colors.gray[700]
					)}`,
				},
				'.datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:first-of-type, .datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:last-of-type':
				{
					position: 'relative',
				},
				'.datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:first-of-type .datatable-pagination-list-item-link, .datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:last-of-type .datatable-pagination-list-item-link':
				{
					color: 'transparent',
				},
				'.dark .datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:first-of-type .datatable-pagination-list-item-link, .dark .datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:last-of-type .datatable-pagination-list-item-link':
				{
					color: 'transparent',
				},
				'.datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:first-of-type .datatable-pagination-list-item-link::after':
				{
					content: `url("${svgToDataUri(
						`<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
								<path stroke="${theme(
							'colors.gray.500',
							colors.gray[500]
						)}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14 8-4 4 4 4"/>
							</svg>`
					)}")`,
					position: 'absolute',
					top: '50%',
					left: '50%',
					width: '1.3rem',
					height: '1.3rem',
					transform: 'translate(-50%, -50%)',
				},
				'.datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:first-of-type .datatable-pagination-list-item-link:hover::after':
				{
					content: `url("${svgToDataUri(
						`<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
								<path stroke="${theme(
							'colors.gray.900',
							colors.gray[900]
						)}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14 8-4 4 4 4"/>
							</svg>`
					)}")`,
				},
				'.dark .datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:first-of-type .datatable-pagination-list-item-link::after':
				{
					content: `url("${svgToDataUri(
						`<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
								<path stroke="${theme(
							'colors.gray.400',
							colors.gray[400]
						)}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14 8-4 4 4 4"/>
							</svg>`
					)}")`,
				},
				'.dark .datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:first-of-type .datatable-pagination-list-item-link:hover::after':
				{
					content: `url("${svgToDataUri(
						`<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
								<path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14 8-4 4 4 4"/>
							</svg>`
					)}")`,
				},
				'.datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:last-of-type .datatable-pagination-list-item-link::after':
				{
					content: `url("${svgToDataUri(
						`<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
							<path stroke="${theme(
							'colors.gray.500',
							colors.gray[500]
						)}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
							</svg>
							`
					)}")`,
					position: 'absolute',
					top: '50%',
					right: '50%',
					width: '1.3rem',
					height: '1.3rem',
					transform: 'translate(50%, -50%)',
				},
				'.datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:last-of-type .datatable-pagination-list-item-link:hover::after':
				{
					content: `url("${svgToDataUri(
						`<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
							<path stroke="${theme(
							'colors.gray.900',
							colors.gray[900]
						)}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
							</svg>
							`
					)}")`,
				},
				'.dark .datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:last-of-type .datatable-pagination-list-item-link::after':
				{
					content: `url("${svgToDataUri(
						`<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
							<path stroke="${theme(
							'colors.gray.400',
							colors.gray[400]
						)}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
							</svg>
							`
					)}")`,
				},
				'.dark .datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:last-of-type .datatable-pagination-list-item-link:hover::after':
				{
					content: `url("${svgToDataUri(
						`<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
							<path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
							</svg>
							`
					)}")`,
				},
				'.datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:first-of-type .datatable-pagination-list-item-link':
				{
					borderTopLeftRadius: `${theme(
						'borderRadius.lg',
						borderRadius.lg
					)}`,
					borderBottomLeftRadius: `${theme(
						'borderRadius.lg',
						borderRadius.lg
					)}`,
					borderLeft: `1px solid ${theme('colors.gray.300')}`,
				},
				'.dark .datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:first-of-type .datatable-pagination-list-item-link':
				{
					borderLeft: `1px solid ${theme('colors.gray.700')}`,
				},

				'.datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item-link:hover':
				{
					backgroundColor: `${theme('colors.gray.50')}`,
					color: `${theme(
						'colors.gray.700',
						colors.gray[700]
					)}`,
				},
				'.dark .datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item-link:hover':
				{
					backgroundColor: `${theme('colors.gray.700')}`,
					color: 'white',
				},
				'@screen sm': {
					'.datatable-wrapper .datatable-top': {
						flexDirection: 'row-reverse',
						alignItems: 'center',
					},
					'.datatable-wrapper .datatable-bottom': {
						flexDirection: 'row',
						alignItems: 'center',
					},
				},

				'.datatable-wrapper .datatable-bottom .datatable-pagination .datatable-pagination-list-item:last-of-type .datatable-pagination-list-item-link':
				{
					borderTopRightRadius: `${theme(
						'borderRadius.lg',
						borderRadius.lg
					)}`,
					borderBottomRightRadius: `${theme(
						'borderRadius.lg',
						borderRadius.lg
					)}`,
					borderLeft: '0px',
				},
			});
		}),
	],
} satisfies Config;


