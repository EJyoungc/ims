<div>
    {{-- In work, do what you enjoy. --}}
    <div wire:poll.10000ms='checkuser' ></div>

    <x-modal title="Recovery Question" :status="$modal">


        <form wire:submit.prevent="store">

            {{-- Security Question --}}
            <div class="form-group">
                <label for="security_question">Security Question</label>
                <select class="form-control" id="security_question" wire:model="security_question" >
                    <option value="" selected>
                        -- Select your question --
                    </option>

                    <option value="pet_name">What was the name of your first pet?</option>
                    <option value="birth_city">In which city were you born?</option>
                    <option value="favorite_teacher">What is the name of your favorite teacher?</option>
                    <option value="first_school">What was the name of your first school?</option>
                    <option value="favorite_food">What is your favorite food?</option>
                </select>
                @error('security_question')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Answer --}}
            <div class="form-group">
                <label for="answer">Your Answer</label>
                <input type="text" class="form-control" id="answer" wire:model="answer" >
                @error('answer')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary btn-block">
            Update <x-spinner for="store" />
            </button>
        </form>


    </x-modal>



</div>
