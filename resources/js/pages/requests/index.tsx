import { StatusBadge } from '@/components/request/status-badge';
import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type FacilityRequestSummary } from '@/types';
import { Head, Link } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Calendar', href: '/dashboard' },
    { title: 'Requests', href: '/requests' },
];

interface Props {
    requests: FacilityRequestSummary[];
    canApprove: boolean;
}

export default function RequestsIndex({ requests, canApprove }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Request Status" />
            <div className="flex h-full flex-1 flex-col gap-4 p-4">
                <div className="flex items-center justify-between">
                    <h1 className="text-2xl font-bold tracking-tight">Request status</h1>
                    {!canApprove && (
                        <Button asChild>
                            <Link href="/requests/create">New request</Link>
                        </Button>
                    )}
                </div>

                <div className="rounded-xl border bg-background">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Event / Department</TableHead>
                                <TableHead>Date filed</TableHead>
                                <TableHead>Date needed</TableHead>
                                <TableHead>Status</TableHead>
                                <TableHead className="text-right">Actions</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {requests.length === 0 && (
                                <TableRow>
                                    <TableCell colSpan={5} className="text-center text-muted-foreground">
                                        No requests yet.
                                    </TableCell>
                                </TableRow>
                            )}
                            {requests.map((r) => (
                                <TableRow key={r.id}>
                                    <TableCell className="font-medium">{r.department}</TableCell>
                                    <TableCell>{r.date_filed}</TableCell>
                                    <TableCell>{r.date_needed}</TableCell>
                                    <TableCell>
                                        <StatusBadge status={r.status} />
                                    </TableCell>
                                    <TableCell className="text-right">
                                        <Button asChild size="sm" variant="outline">
                                            <Link href={`/requests/${r.id}`}>View details</Link>
                                        </Button>
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
