/*
Document: base_tables_datatables.js
Description: Custom JS code used in Tables Datatables Page
 */

var BaseTableDatatables = function() {

	// Init simple DataTable for products list: https://www.datatables.net/
	var initDataTableProduct = function() {
		jQuery( '#ProductsTable' ).dataTable({
			columnDefs: [ 
				{ orderable: false, targets: [ 5,9 ] }, 
			],
			pageLength: 30,
			lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
			pagingType: "full_numbers",
			searching: false,
			oLanguage: {
				sLengthMenu: ''
			},
			dom:
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-6'i><'col-sm-6'p>>"
		});
	};

	// Init simple DataTable for categories list
	var initDataTableCategory = function() {
		jQuery( '#CategoriesTable' ).dataTable({
			columnDefs: [ 
				{ orderable: false, targets: [ 2,7 ] }, 
			],
			pageLength: 30,
			lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
			pagingType: "full_numbers",
			searching: false,
			oLanguage: {
				sLengthMenu: ''
			},
			dom:
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-6'i><'col-sm-6'p>>"
		});
	};

	// Init simple DataTable for slides list
	var initDataTableSlide = function() {
		jQuery( '#SlidesTable' ).dataTable({
			columnDefs: [ 
				{ orderable: false, targets: [ 1,2,3,6,9 ] }, 
			],
			pageLength: 30,
			searching: false,
			oLanguage: {
				sLengthMenu: ''
			},
			dom:
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-6'i><'col-sm-6'p>>"
		});
	};

	// Init simple DataTable for states list
	var initDataTableState = function() {
		jQuery( '#StatesTable' ).dataTable({
			columnDefs: [ 
				{ orderable: false, targets: [ 5 ] }, 
			],
			pageLength: 30,
			searching: false,
			oLanguage: {
				sLengthMenu: ''
			},
			dom:
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-6'i><'col-sm-6'p>>"
		});
	};

	// Init simple DataTable for editors list
	var initDataTableState = function() {
		jQuery( '#EditorsTable' ).dataTable({
			columnDefs: [ 
				{ orderable: false, targets: [ 2,7 ] }, 
			],
			pageLength: 30,
			searching: false,
			oLanguage: {
				sLengthMenu: ''
			},
			dom:
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-6'i><'col-sm-6'p>>"
		});
	};

	// DataTables Bootstrap integration
	var bsDataTables = function() {
		var $DataTable = jQuery.fn.dataTable;

		// Set the defaults for DataTables init
		jQuery.extend( true, $DataTable.defaults, {
			dom:
				"<'row'<'col-sm-6'l><'col-sm-6'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-6'i><'col-sm-6'p>>",
			renderer: 'bootstrap',
			oLanguage: {
				sLengthMenu: "_MENU_",
				sInfo: "Showing <strong>_START_</strong>-<strong>_END_</strong> of <strong>_TOTAL_</strong>",
				oPaginate: {
					sPrevious: '<i class="ion-ios-arrow-left"></i>',
					sNext: '<i class="ion-ios-arrow-right"></i>'
				}
			}
		});

		// Default class modification
		jQuery.extend($DataTable.ext.classes, {
			sWrapper: "dataTables_wrapper form-inline dt-bootstrap",
			sFilterInput: "form-control",
			sLengthSelect: "form-control"
		});

		// Bootstrap paging button renderer
		$DataTable.ext.renderer.pageButton.bootstrap = function (settings, host, idx, buttons, page, pages) {
			var api     = new $DataTable.Api(settings);
			var classes = settings.oClasses;
			var lang    = settings.oLanguage.oPaginate;
			var btnDisplay, btnClass;

			var attach = function (container, buttons) {
				var i, ien, node, button;
				var clickHandler = function (e) {
					e.preventDefault();
					if ( !jQuery(e.currentTarget).hasClass( 'disabled')) {
						api.page(e.data.action).draw(false);
					}
				};

				for (i = 0, ien = buttons.length; i < ien; i++) {
					button = buttons[i];

					if ( jQuery.isArray(button)) {
						attach(container, button);
					}
					else {
						btnDisplay = '';
						btnClass = '';

						switch (button) {
							case 'ellipsis':
								btnDisplay = '&hellip;';
								btnClass = 'disabled';
								break;

							case 'first':
								btnDisplay = lang.sFirst;
								btnClass = button + (page > 0 ? '' : ' disabled' );
								break;

							case 'previous':
								btnDisplay = lang.sPrevious;
								btnClass = button + (page > 0 ? '' : ' disabled' );
								break;

							case 'next':
								btnDisplay = lang.sNext;
								btnClass = button + (page < pages - 1 ? '' : ' disabled' );
								break;

							case 'last':
								btnDisplay = lang.sLast;
								btnClass = button + (page < pages - 1 ? '' : ' disabled' );
								break;

							default:
								btnDisplay = button + 1;
								btnClass = page === button ?
										'active' : '';
								break;
						}

						if ( btnDisplay) {
							node = jQuery( '<li>', {
								'class': classes.sPageButton + ' ' + btnClass,
								'aria-controls': settings.sTableId,
								'tabindex': settings.iTabIndex,
								'id': idx === 0 && typeof button === 'string' ?
										settings.sTableId + '_' + button :
										null
							})
							.append(jQuery( '<a>', {
									'href': '#'
								})
								.html(btnDisplay)
							)
							.appendTo(container);

							settings.oApi._fnBindAction(
								node, {action: button}, clickHandler
							);
						}
					}
				}
			};

			attach(
				jQuery( host ).empty().html( '<ul class="pagination"/>' ).children( 'ul' ),
				buttons
			);
		};

		// TableTools Bootstrap compatibility - Required TableTools 2.1+
		if ( $DataTable.TableTools ) {
			// Set the classes that TableTools uses to something suitable for Bootstrap
			jQuery.extend(true, $DataTable.TableTools.classes, {
				"container": "DTTT btn-group",
				"buttons": {
					"normal": "btn btn-default",
					"disabled": "disabled"
				},
				"collection": {
					"container": "DTTT_dropdown dropdown-menu",
					"buttons": {
						"normal": "",
						"disabled": "disabled"
					}
				},
				"print": {
					"info": "DTTT_print_info"
				},
				"select": {
					"row": "active"
				}
			});

			// Have the collection use a bootstrap compatible drop down
			jQuery.extend( true, $DataTable.TableTools.DEFAULTS.oTags, {
				"collection": {
					"container": "ul",
					"button": "li",
					"liner": "a"
				}
			});
		}
	};

	return {
		init: function() {
			// Init Datatables
			bsDataTables();
			initDataTableProduct();
			initDataTableCategory();
			initDataTableSlide();
			initDataTableState();
		}
	};
}();

// Initialize when page loads
jQuery( function() {
	BaseTableDatatables.init();
});
