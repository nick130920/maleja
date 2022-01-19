@csrf
                                    <label for="title" class="form-label">quien solicita</label>
                                    <input type="text" required :value="old('title')" name="title" class="input" style="margin-bottom: 10px"
                                        id="title">
                                    <label class="form-label" id="valueFromMyButton" for="count">fecha y hora</label>
                                    <input type='datetime-local' min="2018-01-01" max="2200-12-31" value="2021-09-13" id="start" :value="old('start')" name="start" class="input" style="margin-bottom: 10px" required />

                                    <label for="phone_number" class="form-label">Celular</label>
                                    <input type='number' name="phone_number" :value="old('phone_number')" id="phone_number" class="input" style="margin-bottom: 10px" placeholder="Ejemplo: 3124567890" />
                                    <label for="class" class="form-label">Tipo servicio</label>
                                    <select style="background: #000;" class="input-select" aria-label="Default select example" name="service_id"
                                        :value="old('service_id')" require>
                                        <option></option>
                                        @foreach ($servicios as $servicio)
                                            <option style="color: #999" value={{ $servicio->id }}>{{ $servicio->name }}
                                                {{ $servicio->time }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label for="body" class="form-label">Evento</label>
                                    <textarea id="body" name="event" :value="old('event')" required class="input"
                                        rows="3" style="margin-top: 0px; margin-bottom: 10px; height: 55px;"></textarea>
                                    <input type="button" value="Cancel" class="button" id="cancel-button">
                                    <button type="submit" class="button button-white" id="ok-button"><i class="fa fa-check"></i>OK</button>