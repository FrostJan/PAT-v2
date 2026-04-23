import { StatusBadge } from '@/components/request/status-badge';
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
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type FacilityRequestSummary } from '@/types';
import { Head, Link, router } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Calendar', href: '/dashboard' },
    { title: 'Approvals', href: '/approvals' },
];

interface Props {
    requests: FacilityRequestSummary[];
}

export default function ApprovalsIndex({ requests }: Props) {
    const decide = (id: number, status: 'approved' | 'declined') => {
        router.patch(`/requests/${id}/status`, { status }, { preserveScroll: true });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Approvals" />
            <div className="flex h-full flex-1 flex-col gap-4 p-4">
                <h1 className="text-2xl font-bold tracking-tight">Approval requests</h1>

                <div className="rounded-xl border bg-background">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Department</TableHead>
                                <TableHead>Activity</TableHead>
                                <TableHead>Date filed</TableHead>
                                <TableHead>Date needed</TableHead>
                                <TableHead>Submitted by</TableHead>
                                <TableHead>Status</TableHead>
                                <TableHead className="text-right">Actions</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {requests.length === 0 && (
                                <TableRow>
                                    <TableCell colSpan={7} className="text-center text-muted-foreground">
                                        No requests to review.
                                    </TableCell>
                                </TableRow>
                            )}
                            {requests.map((r) => (
                                <TableRow key={r.id}>
                                    <TableCell className="font-medium">{r.department}</TableCell>
                                    <TableCell>{r.activity_purpose}</TableCell>
                                    <TableCell>{r.date_filed}</TableCell>
                                    <TableCell>{r.date_needed}</TableCell>
                                    <TableCell>{r.user?.name ?? '-'}</TableCell>
                                    <TableCell>
                                        <StatusBadge status={r.status} />
                                    </TableCell>
                                    <TableCell className="space-x-2 text-right">
                                        <Button asChild size="sm" variant="outline">
                                            <Link href={`/requests/${r.id}`}>Open form</Link>
                                        </Button>
                                        <DecideButton id={r.id} status="approved" onDecide={decide} />
                                        <DecideButton id={r.id} status="declined" onDecide={decide} />
                                    </TableCell>
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>
                </div>
            </div>
        </AppLayout>
    );
}

function DecideButton({
    id,
    status,
    onDecide,
}: {
    id: number;
    status: 'approved' | 'declined';
    onDecide: (id: number, status: 'approved' | 'declined') => void;
}) {
    const label = status === 'approved' ? 'Approve' : 'Decline';
    return (
        <AlertDialog>
            <AlertDialogTrigger asChild>
                <Button size="sm" variant={status === 'approved' ? 'default' : 'destructive'}>
                    {label}
                </Button>
            </AlertDialogTrigger>
            <AlertDialogContent>
                <AlertDialogHeader>
                    <AlertDialogTitle>{label} request?</AlertDialogTitle>
                    <AlertDialogDescription>
                        {status === 'approved'
                            ? 'An approved request will be added to the shared calendar.'
                            : 'Declining removes this request from the calendar.'}
                    </AlertDialogDescription>
                </AlertDialogHeader>
                <AlertDialogFooter>
                    <AlertDialogCancel>Cancel</AlertDialogCancel>
                    <AlertDialogAction onClick={() => onDecide(id, status)}>{label}</AlertDialogAction>
                </AlertDialogFooter>
            </AlertDialogContent>
        </AlertDialog>
    );
}
