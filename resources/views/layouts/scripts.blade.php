<script>
    var HOST_URL = "https://keenthemes.com/metronic/tools/preview";
</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1200
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#6993FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1E9FF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };
</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('') }}assets/plugins/global/plugins.bundle.js"></script>
<script src="{{ asset('') }}assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="{{ asset('') }}assets/js/scripts.bundle.js"></script>
<script src="{{ asset('') }}assets/js/pages/features/sweetalert2.js"></script>
<!--end::Global Theme Bundle-->
@if (session()->has('success'))
<script>
	var content = {
		title: 'Success',
		message: "{{session()->get('success')}}"
	};
	$.notify(content, {
		type: 'success',
		allow_dismiss: true,
		newest_on_top: true,
		mouse_over: false,
		showProgressbar: false,
		kt_notify_spacing: 10,
		timer: 3000,
		offset: {
			x: 30,
			y: 30
		},
		delay: 1000,
		z_index: 1000,
		animate: {
			enter: 'animate__animated animate__bounceIn',
			exit: 'animate__animated animate__zoomOut'
		}
	});

</script>
@endif
@if (session()->has('error'))
<script>
	var content = {
		title: 'Error',
		message: "{{session()->get('error')}}"
	};
	$.notify(content, {
		type: 'primaDangerry',
		allow_dismiss: true,
		newest_on_top: true,
		mouse_over: false,
		showProgressbar: false,
		kt_notify_spacing: 10,
		timer: 3000,
		offset: {
			x: 30,
			y: 30
		},
		delay: 1000,
		z_index: 1000,
		animate: {
			enter: 'animate__animated animate__bounceIn',
			exit: 'animate__animated animate__zoomOut'
		}
	});

</script>
@endif
@stack('scripts')
