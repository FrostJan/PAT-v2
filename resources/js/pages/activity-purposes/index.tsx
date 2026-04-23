import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/components/ui/alert-dialog';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler, useState } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Calendar', href: '/dashboard' },
    { title: 'Activity Purposes', href: '/activity-purposes' },
];

interface Props {
    activityPurposes: { id: number; name: string }[];
}

export default function ActivityPurposesIndex({ activityPurposes }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Activity Purposes" />
            <div className="flex h-full flex-1 flex-col gap-4 p-4">
                <div className="flex items-center justify-between">
                    <h1 className="text-2xl font-bold tracking-tight">Activity purposes</h1>
                    <AddDialog />
                </div>

                <div className="rounded-xl border bg-background">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Name</TableHead>
                                <TableHead className="text-right">Actions</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {activityPurposes.map((p) => (
                                <Row key={p.id} id={p.id} name={p.name} />
                            ))}
                        </TableBody>
                    </Table>
                </div>
            </div>
        </AppLayout>
    );
}

function Row({ id, name }: { id: number; name: string }) {
    return (
        <TableRow>
            <TableCell className="font-medium">{name}</TableCell>
            <TableCell className="space-x-2 text-right">
                <EditDialog id={id} initialName={name} />
                <DeleteDialog id={id} name={name} />
            </TableCell>
        </TableRow>
    );
}

function AddDialog() {
    const [open, setOpen] = useState(false);
    const { data, setData, post, processing, errors, reset } = useForm({ name: '' });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post('/activity-purposes', {
            onSuccess: () => {
                reset();
                setOpen(false);
            },
            preserveScroll: true,
        });
    };

    return (
        <Dialog open={open} onOpenChange={setOpen}>
            <DialogTrigger asChild>
                <Button>Add purpose</Button>
            </DialogTrigger>
            <DialogContent>
                <form onSubmit={submit} className="space-y-4">
                    <DialogHeader>
                        <DialogTitle>Add activity purpose</DialogTitle>
                    </DialogHeader>
                    <div className="space-y-2">
                        <Label htmlFor="name">Name</Label>
                        <Input id="name" value={data.name} onChange={(e) => setData('name', e.target.value)} />
                        {errors.name && <p className="text-sm text-red-600">{errors.name}</p>}
                    </div>
                    <DialogFooter>
                        <Button type="submit" disabled={processing}>
                            Save
                        </Button>
                    </DialogFooter>
                </form>
            </DialogContent>
        </Dialog>
    );
}

function EditDialog({ id, initialName }: { id: number; initialName: string }) {
    const [open, setOpen] = useState(false);
    const { data, setData, patch, processing, errors } = useForm({ name: initialName });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        patch(`/activity-purposes/${id}`, {
            onSuccess: () => setOpen(false),
            preserveScroll: true,
        });
    };

    return (
        <Dialog open={open} onOpenChange={setOpen}>
            <DialogTrigger asChild>
                <Button size="sm" variant="outline">
                    Edit
                </Button>
            </DialogTrigger>
            <DialogContent>
                <form onSubmit={submit} className="space-y-4">
                    <DialogHeader>
                        <DialogTitle>Edit activity purpose</DialogTitle>
                    </DialogHeader>
                    <div className="space-y-2">
                        <Label htmlFor="edit-name">Name</Label>
                        <Input id="edit-name" value={data.name} onChange={(e) => setData('name', e.target.value)} />
                        {errors.name && <p className="text-sm text-red-600">{errors.name}</p>}
                    </div>
                    <DialogFooter>
                        <Button type="submit" disabled={processing}>
                            Save
                        </Button>
                    </DialogFooter>
                </form>
            </DialogContent>
        </Dialog>
    );
}

function DeleteDialog({ id, name }: { id: number; name: string }) {
    const { delete: destroy } = useForm();

    return (
        <AlertDialog>
            <AlertDialogTrigger asChild>
                <Button size="sm" variant="destructive">
                    Delete
                </Button>
            </AlertDialogTrigger>
            <AlertDialogContent>
                <AlertDialogHeader>
                    <AlertDialogTitle>Delete "{name}"?</AlertDialogTitle>
                    <AlertDialogDescription>This cannot be undone. Requests already using this purpose will keep their value.</AlertDialogDescription>
                </AlertDialogHeader>
                <AlertDialogFooter>
                    <AlertDialogCancel>Cancel</AlertDialogCancel>
                    <AlertDialogAction onClick={() => destroy(`/activity-purposes/${id}`, { preserveScroll: true })}>Delete</AlertDialogAction>
                </AlertDialogFooter>
            </AlertDialogContent>
        </AlertDialog>
    );
}
