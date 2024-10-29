@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-5">
        <div class="bg-white shadow-md rounded p-6">
            <h1 class="text-3xl font-bold mb-5">Editar Morador</h1>
            <form action="{{ route('moradores.update', ['morador' => $morador->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-4 gap-4 mb-4">
                    @if($morador->imagem)
                        <img src="{{ asset($morador->imagem) }}" alt="Imagem do Morador"
                             class="w-32 h-32 rounded-full col-span-1">
                    @endif
                    <div id="image-upload" x-data="imageUploadHandler()" class="col-span-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Alterar Imagem:</label>
                        <input type="file" name="imagem" id="imagem-input" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" @change="handleImageUpload">

                        <template x-if="imageUrl">
                            <img :src="imageUrl" class="w-32 h-32 rounded-full mt-2"/>
                        </template>

                        <!-- Modal para Crop -->
                        <div x-show="open" @click.away="closeModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
                            <div class="bg-white rounded-lg p-6">
                                <h5 class="text-lg font-bold mb-2">Cortar Imagem</h5>
                                <img x-ref="cropImage" :src="imageUrl" style="max-width: 100%;" @load="initializeCropper">
                                <div class="mt-4">
                                    <button type="button" @click="cropImage" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Cortar Imagem</button>
                                    <button type="button" @click="closeModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="imagem_temp" id="imagem_temp" value="{{ session('imagem_temp') ?? '' }}" class="col-span-4">
                </div>

                @include('moradores.form', ['unidades' => $unidades])

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Atualizar Morador</button>
            </form>
        </div>
    </div>

    <script>
        function imageUploadHandler() {
            return {
                open: false,
                imageUrl: '',
                cropper: null,
                handleImageUpload(event) {
                    const files = event.target.files;
                    if (files && files.length > 0) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.imageUrl = e.target.result;
                            this.open = true;
                        };
                        reader.readAsDataURL(files[0]);
                    }
                },
                initializeCropper() {
                    if (this.cropper) this.cropper.destroy();
                    const imageElement = this.$refs.cropImage;
                    this.cropper = new Cropper(imageElement, {
                        aspectRatio: 1,
                        viewMode: 1,
                    });
                },
                cropImage() {
                    if (!this.cropper) return;

                    const canvas = this.cropper.getCroppedCanvas({
                        width: 300,
                        height: 300,
                    });

                    canvas.toBlob((blob) => {
                        const formData = new FormData();
                        formData.append('imagem', blob);

                        const uploadUrl = "{{ route('moradores.uploadImagem') }}";
                        fetch(uploadUrl, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    this.imageUrl = data.imageUrl;
                                    document.getElementById('imagem_temp').value = data.imageUrl;
                                }
                            });
                    });

                    this.open = false;
                    this.cropper.destroy();
                    this.cropper = null;
                },
                closeModal() {
                    this.open = false;
                    if (this.cropper) {
                        this.cropper.destroy();
                        this.cropper = null;
                    }
                }
            }
        }
    </script>
@endsection
