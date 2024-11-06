 <div class="col-md-10 content">

     <div class="card  my-2 p-4" style="text-align: left;">
         <div class="row">
             <h3>{{ __('Upload a new memory') }}</h3>
             <small>
                 {{ __('Upload new memory and save it securely') }}
             </small>

             <div class="container mt-5">


                 <!-- Show success message after upload -->
                 @if (session()->has('message'))
                     <div class="alert alert-success">
                         {{ session('message') }}
                     </div>
                 @endif

                 <form wire:submit.prevent="uploadFile" enctype="multipart/form-data">

                     <div class="mb-3">
                         <label for="title" class="form-label"> {{ __('Media Title') }} </label>
                         <input type="text"
                             class="form-control @error('title')
                            is-invalid
                        @enderror"
                             placeholder="{{ __('Enter the media title') }}" wire:model="title">
                         @error('title')
                             <span class="text-danger">{{ __($message) }}</span>
                         @enderror
                     </div>

                     <!-- File upload input -->
                     <div class="mb-3">
                         <label for="fileInput" class="form-label">{{ __('Upload File') }}</label>
                         <input type="file" wire:model="file" multiple
                             class="form-control @error('file')
                        is-invalid
                    @enderror"
                             id="fileInput">
                         @error('file')
                             <span class="text-danger">{{ __($message) }}</span>
                         @enderror

                         <!-- Progress bar (optional) -->
                         @if ($file)
                             <div class="progress mt-3">
                                 <div class="progress-bar" role="progressbar" style="width: {{ $randomValue }}%;"
                                     @if ($randomValue != 100) wire:poll @endif aria-valuenow="100"
                                     aria-valuemin="0" aria-valuemax="100">
                                     @if ($randomValue == 100)
                                         {{ __('Uploaded') }}
                                     @else
                                         {{ __('Uploading') }}
                                     @endif
                                 </div>
                             </div>

                             @if ($randomValue == 100)
                                 <h5>{{ __('Process completed, and file uploaded and encrypted.') }}
                                 </h5>
                             @else
                                 <h5>{{ __('Process will take minutes, we are processing and encrypting your media, do not leave the page.') }}
                                 </h5>
                             @endif

                         @endif
                     </div>

                     <!-- Submit button -->
                     <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                 </form>
             </div>

         </div>
     </div>

     <div class="card my-2 p-4">
         <div class="row" style="text-align: left;">
             <h3>{{ __('Memories') }}</h3>

             <small>
                 {{ __('Your uploaded memories') }}
             </small>

             @foreach ($memories as $memory)
                 @if (count(json_decode($memory->medias)) == 1)
                     <div class="col-sm-6 col-md-4 my-3" style="cursor: pointer;"
                         wire:click="goToAttachment({{ $memory->id }})">
                         <div class="card" style=" background-color: #ddd;">
                             <i class="bi bi-image icon"></i>
                             <i class="bi bi-lock lock-icon"></i>
                             <h5 class="card-title">{{ $memory->message . __(' - Encrypted') }}</h5>
                         </div>
                     </div>
                 @else
                     <div class="col-sm-6 col-md-4 my-3">
                         <div class="card" style=" background-color: #ddd;">
                             <i class="bi bi-image icon"></i>
                             <i class="bi bi-lock lock-icon"></i>
                             <h5 class="card-title">
                                 {{ $memory->message . ' - ' . count(json_decode($memory->medias)) . __(' Attachements') }}
                             </h5>
                         </div>
                     </div>
                 @endif
             @endforeach
         </div>
     </div>

 </div>
