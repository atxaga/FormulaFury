import DangerButton from '@/Components/DangerButton';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import Modal from '@/Components/Modal';
import SecondaryButton from '@/Components/SecondaryButton';
import TextInput from '@/Components/TextInput';
import { useForm } from '@inertiajs/react';
import { useRef, useState } from 'react';

export default function DeleteUserForm({ className = '' }) {
    const [confirmingUserDeletion, setConfirmingUserDeletion] = useState(false);
    const passwordInput = useRef();

    const {
        data,
        setData,
        delete: destroy,
        processing,
        reset,
        errors,
        clearErrors,
    } = useForm({
        password: '',
    });

    const confirmUserDeletion = () => {
        setConfirmingUserDeletion(true);
    };

    const deleteUser = (e) => {
        e.preventDefault();

        destroy(route('profile.destroy'), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => passwordInput.current.focus(),
            onFinish: () => reset(),
        });
    };

    const closeModal = () => {
        setConfirmingUserDeletion(false);

        clearErrors();
        reset();
    };

    return (
        <section className={`space-y-6 ${className}`}>
            <header>
                <h2 className="infor text-lg font-medium text-white">
                    Kontua ezabatu
                </h2>

                <p className="mt-1 text-sm text-gray-600">
                    Kontua ezabatzen baduzu, zure datuak aplikaziotik betirako ezabatu egingo 
                    dira.
                </p>
            </header>

            <DangerButton onClick={confirmUserDeletion}>
                Kontua ezabatu
            </DangerButton>

            <Modal show={confirmingUserDeletion} onClose={closeModal}>
                <form onSubmit={deleteUser} className="profilaHeader p-6">
                    <h2 className="text-lg font-medium text-white">
                        Zihur zaude kontua ezabatu nahi duzula?
                    </h2>

                    <p className="mt-1 text-sm text-gray-600">
                    Kontua ezabatzen baduzu, zure datuak aplikaziotik betirako ezabatu egingo 
                    dira.
                    </p>

                    <div className="mt-6">
                        <InputLabel
                            htmlFor="password"
                            value="Pasahitza"
                            className="sr-only"
                        />

                        <TextInput
                            id="password"
                            type="password"
                            name="password"
                            ref={passwordInput}
                            value={data.password}
                            onChange={(e) =>
                                setData('password', e.target.value)
                            }
                            className="select mt-1 block w-3/4"
                            isFocused
                            placeholder="Pasahitza"
                        />

                        <InputError
                            message={errors.password}
                            className="mt-2"
                        />
                    </div>

                    <div className="mt-6 flex justify-end">
                        <SecondaryButton onClick={closeModal}>
                            Atzera
                        </SecondaryButton>

                        <DangerButton className="ms-3" disabled={processing}>
                            Kontua ezabatu
                        </DangerButton>
                    </div>
                </form>
            </Modal>
        </section>
    );
}
