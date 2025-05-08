<div x-data="globalNotification()" x-init="init()" x-show="visible" x-transition x-cloak
    class="fixed z-50 p-4 w-80 rounded-lg shadow-lg bg-red-200" :class="positionClasses">
    <div :class="typeClasses.container" class="flex items-start space-x-3">
        <svg :class="typeClasses.icon" class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path x-show="type === 'success'" stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            <path x-show="type === 'error'" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <div class="flex-1">
            <h4 class="font-semibold text-sm" x-text="title"></h4>
            <p class="text-xs mt-1 text-gray-700" x-text="description"></p>
        </div>
        <button @click="close()" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

<script>
    function globalNotification() {
        return {
            visible: false,
            type: 'success',
            title: '',
            description: '',
            position: 'top-right',
            timeout: null,

            init() {
                window.notification = ({
                    type = 'success',
                    title = '',
                    description = '',
                    position = 'top-right',
                    duration = 5000
                }) => {
                    this.type = type
                    this.title = title
                    this.description = description
                    this.position = position
                    this.visible = true

                    clearTimeout(this.timeout)
                    this.timeout = setTimeout(() => this.visible = false, duration)
                }
            },

            close() {
                this.visible = false
                clearTimeout(this.timeout)
            },

            get typeClasses() {
                const types = {
                    success: {
                        container: 'bg-green-100 text-green-800',
                        icon: 'text-green-600'
                    },
                    error: {
                        container: 'bg-red-100 text-red-800',
                        icon: 'text-red-600'
                    },
                    warning: {
                        container: 'bg-yellow-100 text-yellow-800',
                        icon: 'text-yellow-600'
                    },
                    info: {
                        container: 'bg-blue-100 text-blue-800',
                        icon: 'text-blue-600'
                    }
                }
                return types[this.type] || types.success
            },

            get positionClasses() {
                switch (this.position) {
                    case 'top-left':
                        return 'top-4 left-4';
                    case 'top-right':
                        return 'top-4 right-4';
                    case 'bottom-left':
                        return 'bottom-4 left-4';
                    case 'bottom-right':
                        return 'bottom-4 right-4';
                    default:
                        return 'top-4 right-4';
                }
            }
        }
    }
</script>
