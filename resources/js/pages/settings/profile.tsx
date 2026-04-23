import { type BreadcrumbItem, type SharedData } from '@/types';
import { Transition } from '@headlessui/react';
import { Head, Link, router, useForm, usePage } from '@inertiajs/react';
import { ChangeEvent, FormEventHandler, useRef, useState } from 'react';

import DeleteUser from '@/components/delete-user';
import HeadingSmall from '@/components/heading-small';
import InputError from '@/components/input-error';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useInitials } from '@/hooks/use-initials';
import AppLayout from '@/layouts/app-layout';
import SettingsLayout from '@/layouts/settings/layout';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: '/settings/profile',
    },
];

export default function Profile({ mustVerifyEmail, status }: { mustVerifyEmail: boolean; status?: string }) {
    const { auth } = usePage<SharedData>().props;
    const getInitials = useInitials();
    const fileInputRef = useRef<HTMLInputElement>(null);

    const { data, setData, patch, errors, processing, recentlySuccessful } = useForm({
        name: auth.user?.name ?? '',
        email: auth.user?.email ?? '',
    });

    const [avatarProcessing, setAvatarProcessing] = useState(false);
    const [avatarError, setAvatarError] = useState<string | null>(null);
    const [avatarSuccess, setAvatarSuccess] = useState(false);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        patch(route('profile.update'));
    };

    const handleAvatarChange = (event: ChangeEvent<HTMLInputElement>) => {
        const file = event.target.files?.[0];
        if (!file) return;

        setAvatarError(null);
        setAvatarSuccess(false);
        setAvatarProcessing(true);

        router.post(
            route('profile.avatar.update'),
            { avatar: file, _method: 'post' },
            {
                forceFormData: true,
                preserveScroll: true,
                onSuccess: () => {
                    setAvatarSuccess(true);
                    setTimeout(() => setAvatarSuccess(false), 2000);
                },
                onError: (formErrors) => {
                    setAvatarError(formErrors.avatar ?? 'Upload failed. Please try again.');
                },
                onFinish: () => {
                    setAvatarProcessing(false);
                    if (fileInputRef.current) {
                        fileInputRef.current.value = '';
                    }
                },
            },
        );
    };

    const handleAvatarRemove = () => {
        setAvatarError(null);
        setAvatarSuccess(false);
        setAvatarProcessing(true);

        router.delete(route('profile.avatar.destroy'), {
            preserveScroll: true,
            onFinish: () => setAvatarProcessing(false),
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Profile settings" />

            <SettingsLayout>
                <div className="space-y-6">
                    <HeadingSmall title="Profile picture" description="Upload a photo so others recognize you" />

                    <div className="flex flex-col items-start gap-4 sm:flex-row sm:items-center">
                        <Avatar className="h-20 w-20 overflow-hidden rounded-full border">
                            <AvatarImage src={auth.user?.avatar ?? undefined} alt={auth.user?.name ?? ''} />
                            <AvatarFallback className="rounded-full bg-neutral-200 text-lg font-medium text-black dark:bg-neutral-700 dark:text-white">
                                {getInitials(auth.user?.name ?? '')}
                            </AvatarFallback>
                        </Avatar>

                        <div className="flex flex-col gap-2">
                            <div className="flex flex-wrap gap-2">
                                <input
                                    ref={fileInputRef}
                                    type="file"
                                    accept="image/jpeg,image/png,image/webp"
                                    className="hidden"
                                    onChange={handleAvatarChange}
                                />
                                <Button
                                    type="button"
                                    variant="outline"
                                    disabled={avatarProcessing}
                                    onClick={() => fileInputRef.current?.click()}
                                >
                                    {auth.user?.avatar ? 'Change photo' : 'Upload photo'}
                                </Button>
                                {auth.user?.avatar && (
                                    <Button type="button" variant="ghost" disabled={avatarProcessing} onClick={handleAvatarRemove}>
                                        Remove
                                    </Button>
                                )}
                            </div>
                            <p className="text-muted-foreground text-xs">JPG, PNG or WebP. Max 2MB.</p>
                            {avatarError && <p className="text-destructive text-sm">{avatarError}</p>}
                            <Transition
                                show={avatarSuccess}
                                enter="transition ease-in-out"
                                enterFrom="opacity-0"
                                leave="transition ease-in-out"
                                leaveTo="opacity-0"
                            >
                                <p className="text-sm text-neutral-600">Photo updated</p>
                            </Transition>
                        </div>
                    </div>
                </div>

                <div className="space-y-6">
                    <HeadingSmall title="Profile information" description="Update your name and email address" />

                    <form onSubmit={submit} className="space-y-6">
                        <div className="grid gap-2">
                            <Label htmlFor="name">Name</Label>

                            <Input
                                id="name"
                                className="mt-1 block w-full"
                                value={data.name}
                                onChange={(e) => setData('name', e.target.value)}
                                required
                                autoComplete="name"
                                placeholder="Full name"
                            />

                            <InputError className="mt-2" message={errors.name} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="email">Email address</Label>

                            <Input
                                id="email"
                                type="email"
                                className="mt-1 block w-full"
                                value={data.email}
                                onChange={(e) => setData('email', e.target.value)}
                                required
                                autoComplete="username"
                                placeholder="Email address"
                            />

                            <InputError className="mt-2" message={errors.email} />
                        </div>

                        {mustVerifyEmail && auth.user?.email_verified_at === null && (
                            <div>
                                <p className="mt-2 text-sm text-neutral-800">
                                    Your email address is unverified.
                                    <Link
                                        href={route('verification.send')}
                                        method="post"
                                        as="button"
                                        className="rounded-md text-sm text-neutral-600 underline hover:text-neutral-900 focus:ring-2 focus:ring-offset-2 focus:outline-hidden"
                                    >
                                        Click here to re-send the verification email.
                                    </Link>
                                </p>

                                {status === 'verification-link-sent' && (
                                    <div className="mt-2 text-sm font-medium text-green-600">
                                        A new verification link has been sent to your email address.
                                    </div>
                                )}
                            </div>
                        )}

                        <div className="flex items-center gap-4">
                            <Button disabled={processing}>Save</Button>

                            <Transition
                                show={recentlySuccessful}
                                enter="transition ease-in-out"
                                enterFrom="opacity-0"
                                leave="transition ease-in-out"
                                leaveTo="opacity-0"
                            >
                                <p className="text-sm text-neutral-600">Saved</p>
                            </Transition>
                        </div>
                    </form>
                </div>

                <DeleteUser />
            </SettingsLayout>
        </AppLayout>
    );
}
