<div class="flex items-center justify-center bg-gray-900 max-w-min rounded-full">
    <div class="relative w-32 h-32 rounded-full bg-gray-800 border-8 border-gray-600 custom-spin overflow-hidden">
        <!-- Дорожки виниловой пластинки -->
        <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-gray-700 via-gray-800 to-gray-700 rounded-full opacity-40"></div>
        <!-- Центральная этикетка -->
        <div class="absolute inset-0 w-2/5 h-2/5 text-center bg-blue rounded-full m-auto flex items-center justify-center text-white text-xs font-bold">
            <span>Bro Label</span>
        </div>
        <!-- Центральное отверстие -->
        <div class="absolute inset-0 w-2 h-2 bg-gray-300 rounded-full m-auto"></div>
        <!-- Маленькие царапины -->
        <div class="absolute inset-0 flex justify-between items-center px-2">
            <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
            <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
        </div>
        <!-- Дополнительные царапины -->
        <div class="absolute inset-0 w-3 h-1 bg-gray-400 rounded-full m-auto transform rotate-12 opacity-50"></div>
        <div class="absolute inset-0 w-3 h-1 bg-gray-400 rounded-full m-auto transform -rotate-12 opacity-50"></div>
    </div>
</div>

<style>
    @keyframes custom-spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    .custom-spin {
        animation: custom-spin 3s linear infinite;
    }
</style>
