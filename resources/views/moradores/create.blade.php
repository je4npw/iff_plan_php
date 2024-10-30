@extends('layouts.app')

@section('content')
    <script>
        const uploadUrl = "{{ route('moradores.uploadImagem') }}";
        const csrfToken = "{{ csrf_token() }}";

        window.imageCropper = function () {
            return {
                open: false,
                imageUrl: '',
                cropper: null,

                handleImageUpload(event) {
                    const files = event.target.files;
                    const done = (url) => {
                        this.imageUrl = url; // Armazena a URL da imagem
                    };

                    if (files && files.length > 0) {
                        const reader = new FileReader();
                        reader.onload = (event) => {
                            done(reader.result);
                            this.open = true; // Abre o modal
                            this.$nextTick(() => {
                                // Atribui a imagem ao <img> no modal
                                const imageElement = document.getElementById('image-to-crop');
                                imageElement.src = this.imageUrl;

                                // Cria uma nova instância do Cropper
                                if (this.cropper) {
                                    this.cropper.destroy(); // Destrói a instância anterior, se existir
                                }
                                this.cropper = new Cropper(imageElement, {
                                    aspectRatio: 1, // Mantém a proporção
                                    viewMode: 1,
                                });
                            });
                        };
                        reader.readAsDataURL(files[0]);
                    }
                },

                cropImage() {
                    if (this.cropper) {
                        const canvas = this.cropper.getCroppedCanvas({
                            width: 300,
                            height: 300,
                        });

                        canvas.toBlob((blob) => {
                            const formData = new FormData();
                            formData.append('imagem', blob, 'cropped-image.png'); // Define um nome para a imagem

                            fetch(uploadUrl, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Atualizar a imagem pré-visualizada
                                        const previewElement = document.getElementById('image-upload-preview');
                                        if (previewElement) {
                                            previewElement.innerHTML = '<img src="' + data.imageUrl + '" class="w-32 h-32 rounded-full">';
                                            document.getElementById('imagem_temp').value = data.imageUrl; // Atualizar o campo oculto
                                        }
                                    } else {
                                        console.error(data.message); // Log de erro, se necessário
                                    }
                                })
                                .catch(error => {
                                    console.error('Erro ao enviar a imagem:', error);
                                });

                            this.open = false; // Fecha o modal
                        });
                    }
                },
            };
        };
    </script>

    <div class="container mx-auto mt-5">
        <div class="bg-white shadow-md rounded p-6" x-data="imageCropper()">
            <h1 class="text-3xl font-bold mb-5">Cadastrar Morador</h1>
            <form action="{{ route('moradores.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div id="image-upload" class="col-span-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Alterar Imagem:</label>
                        <input type="file" name="imagem" id="imagem-input"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               @change="handleImageUpload($event)">

                        <!-- Elemento para mostrar a imagem cropped -->
                        <div id="image-upload-preview" class="mt-4">
                            @if(session('imagem_temp'))
                                <img src="{{ asset('storage/' . session('imagens_moradores')) }}" alt="Imagem do Morador Temporária"
                                     class="w-32 h-32 rounded-full">
                            @endif
                        </div>

                        <!-- Modal para Crop -->
                        <div x-show="open"
                             class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                             style="display: none;">
                            <div class="bg-white rounded-lg p-6 max-w-lg w-full">
                                <h5 class="text-lg font-bold mb-2">Cortar Imagem</h5>
                                <div class="flex flex-col items-center">
                                    <img id="image-to-crop" style="max-width: 100%; max-height: 400px;">
                                    <div class="mt-4 flex justify-between w-full">
                                        <button type="button" @click="cropImage"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Cortar Imagem
                                        </button>
                                        <button type="button" @click="open = false; if (cropper) cropper.destroy();"
                                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                            Fechar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <input type="hidden" name="imagem_temp" id="imagem_temp" value="{{ session('imagem_temp') ?? '' }}"
                           class="col-span-4">
                </div>
                @include('moradores.form', ['unidades' => $unidades])
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Cadastrar Morador
                </button>
            </form>
        </div>
    </div>
@endsection
