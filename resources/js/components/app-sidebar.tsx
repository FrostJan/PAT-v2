import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem, type SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import { BookOpen, CheckCircle2, ClipboardCheck, History, ListChecks, PieChart, ScrollText } from 'lucide-react';
import AppLogo from './app-logo';

const calendarItem: NavItem = {
    title: 'Calendar',
    url: '/dashboard',
    icon: BookOpen,
};

const adminItems: NavItem[] = [
    { title: 'Document History', url: '/document-history', icon: History, permission: 'document-history.view' },
    { title: 'Log', url: '/log', icon: ScrollText, role: 'admin' },
    { title: 'Summary Statistics', url: '/summary', icon: PieChart, permission: 'summary.view' },
    { title: 'Activity Purposes', url: '/activity-purposes', icon: ListChecks, role: 'admin' },
];

const departmentItems: NavItem[] = [
    { title: 'Approvals', url: '/approvals', icon: CheckCircle2, permission: 'request.approve' },
    { title: 'Summary Statistics', url: '/summary', icon: PieChart, permission: 'summary.view' },
    { title: 'Facility Form', url: '/requests/create', icon: BookOpen, permission: 'request.create' },
];

const studentItems: NavItem[] = [
    { title: 'Facility Form', url: '/requests/create', icon: BookOpen, permission: 'request.create' },
    { title: 'Request Status', url: '/requests', icon: ClipboardCheck, permission: 'request.view.own' },
];

export function AppSidebar() {
    const page = usePage<SharedData>();
    const user = page.props.auth.user;

    const roles = user?.roles ?? [];
    const perms = user?.permissions ?? [];

    const has = (item: NavItem) => {
        if (item.role && !roles.includes(item.role)) return false;
        if (item.permission && !perms.includes(item.permission)) return false;
        return true;
    };

    const items: NavItem[] = [calendarItem];
    if (roles.includes('admin')) items.push(...adminItems.filter(has));
    if (roles.includes('department_office')) items.push(...departmentItems.filter(has));
    if (roles.includes('student')) items.push(...studentItems.filter(has));

    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href="/dashboard" prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={items} />
            </SidebarContent>

            <SidebarFooter>
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
